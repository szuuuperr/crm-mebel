<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            return view('pelanggan.proyek.index', [
                'activePage' => 'proyek',
                'projects' => collect(),
            ]);
        }

        $query = Project::where('customer_id', $customer->id)
            ->with('milestones');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('nama', 'like', "%{$request->search}%");
        }

        $projects = $query->latest()->paginate(15)->withQueryString();

        return view('pelanggan.proyek.index', [
            'activePage' => 'proyek',
            'projects' => $projects,
        ]);
    }

    public function show($id)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            abort(404);
        }

        $project = Project::where('customer_id', $customer->id)
            ->with(['milestones', 'order.items.product'])
            ->findOrFail($id);

        $milestones = $project->milestones;
        $completedMilestones = $milestones->where('status', 'selesai')->count();
        $totalMilestones = $milestones->count();

        return view('pelanggan.proyek.show', [
            'activePage' => 'proyek',
            'project' => $project,
            'milestones' => $milestones,
            'completedMilestones' => $completedMilestones,
            'totalMilestones' => $totalMilestones,
        ]);
    }
}
