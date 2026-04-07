<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Project;
use App\Models\WoodType;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['customer']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter by prioritas
        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($cq) use ($search) {
                        $cq->where('nama', 'like', "%{$search}%")
                            ->orWhere('perusahaan', 'like', "%{$search}%");
                    });
            });
        }

        // Sort
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->oldest();
        } elseif ($sort === 'deadline') {
            $query->orderBy('target_selesai', 'asc');
        } elseif ($sort === 'progress_terendah') {
            $query->orderBy('progress', 'asc');
        } elseif ($sort === 'progress_tertinggi') {
            $query->orderBy('progress', 'desc');
        } else {
            $query->latest();
        }

        $projects = $query->paginate(18);

        // Stats (from all projects, not just current page)
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'aktif')->count();
        $completedProjects = Project::where('status', 'selesai')->count();
        $delayedProjects = Project::where('status', 'ditunda')->count();

        return view('pages.projects.index', [
            'activePage' => 'projects',
            'projects' => $projects,
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
            'delayedProjects' => $delayedProjects,
        ]);
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $orders = Order::orderBy('id', 'desc')->get();
        $jenisKayus = WoodType::orderBy('nama')->get();

        return view('pages.projects.create', [
            'activePage' => 'projects',
            'customers' => $customers,
            'orders' => $orders,
            'jenisKayus' => $jenisKayus,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'jenis' => 'required|string',
            'prioritas' => 'required|string',
            'anggaran' => 'nullable|numeric',
            'tanggal_mulai' => 'nullable|date',
            'target_selesai' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'kebutuhan_khusus' => 'nullable|string',
            'jenis_kayu_id' => 'nullable|exists:jenis_kayus,id',
            'finishing' => 'nullable|string|max:255',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'berat' => 'nullable|numeric|min:0',
        ]);

        $lastProject = Project::withTrashed()->latest('id')->first();
        $nextNum = $lastProject ? ($lastProject->id + 1) : 1;
        $validated['nomor_faktur'] = 'PRJ-'.str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        $project = Project::create($validated);

        if ($request->has('milestones')) {
            foreach ($request->milestones as $index => $msData) {
                if (empty($msData['nama'])) {
                    continue;
                }
                $project->milestones()->create([
                    'nama' => $msData['nama'],
                    'icon' => $msData['icon'] ?? 'flag',
                    'tanggal_target' => $msData['tanggal_target'] ?? null,
                    'status' => $msData['status'] ?? 'pending',
                    'urutan' => $index,
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function track($id)
    {
        $project = Project::with(['customer', 'order.items.product', 'milestones', 'members.user'])->findOrFail($id);

        return view('pages.projects.track', [
            'activePage' => 'dashboard',
            'project' => $project,
        ]);
    }

    public function show($id)
    {
        $project = Project::with(['customer', 'order.items.product', 'milestones', 'members.user'])->findOrFail($id);

        $milestones = $project->milestones;
        $completedMilestones = $milestones->where('status', 'selesai')->count();
        $totalMilestones = $milestones->count();

        return view('pages.projects.show', [
            'activePage' => 'projects',
            'project' => $project,
            'milestones' => $milestones,
            'completedMilestones' => $completedMilestones,
            'totalMilestones' => $totalMilestones,
        ]);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $customers = Customer::orderBy('nama')->get();
        $orders = Order::orderBy('id', 'desc')->get();
        $jenisKayus = WoodType::orderBy('nama')->get();

        return view('pages.projects.edit', [
            'activePage' => 'projects',
            'project' => $project,
            'customers' => $customers,
            'orders' => $orders,
            'jenisKayus' => $jenisKayus,
        ]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'order_id' => 'nullable|exists:orders,id',
            'jenis' => 'required|string',
            'prioritas' => 'required|string',
            'anggaran' => 'nullable|numeric',
            'tanggal_mulai' => 'nullable|date',
            'target_selesai' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'kebutuhan_khusus' => 'nullable|string',
            'status' => 'required|string',
            'progress' => 'required|integer|min:0|max:100',
            'jenis_kayu_id' => 'nullable|exists:jenis_kayus,id',
            'finishing' => 'nullable|string|max:255',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'berat' => 'nullable|numeric|min:0',
        ]);

        $project->update($validated);

        if ($request->has('milestones')) {
            $submittedIds = collect($request->milestones)->pluck('id')->filter()->toArray();
            $project->milestones()->whereNotIn('id', $submittedIds)->delete();

            foreach ($request->milestones as $index => $msData) {
                if (empty($msData['nama'])) {
                    continue;
                }
                if (! empty($msData['id'])) {
                    $ms = clone $project->milestones()->find($msData['id']);
                    $msSelesai = $msData['status'] ?? 'pending';
                    $tanggalSelesai = ($msSelesai === 'selesai' && ! $ms->tanggal_selesai) ? now() : ($ms->tanggal_selesai ?? null);

                    $project->milestones()->where('id', $msData['id'])->update([
                        'nama' => $msData['nama'],
                        'icon' => $msData['icon'] ?? 'flag',
                        'tanggal_target' => $msData['tanggal_target'] ?? null,
                        'status' => $msSelesai,
                        'urutan' => $index,
                        'tanggal_selesai' => $tanggalSelesai,
                    ]);
                } else {
                    $project->milestones()->create([
                        'nama' => $msData['nama'],
                        'icon' => $msData['icon'] ?? 'flag',
                        'tanggal_target' => $msData['tanggal_target'] ?? null,
                        'status' => $msData['status'] ?? 'pending',
                        'urutan' => $index,
                    ]);
                }
            }
        } else {
            $project->milestones()->delete();
        }

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus!');
    }

    public function saveFeedback(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update([
            'rating' => $request->rating,
            'keluhan_masukan' => $request->keluhan_masukan,
        ]);

        return redirect()->route('projects.show', $id)->with('success', 'Penilaian berhasil disimpan.');
    }
}
