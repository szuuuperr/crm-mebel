<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%");
            });
        }

        if ($request->filled('loyalitas')) {
            $query->where('status_loyalitas', $request->loyalitas);
        }

        $customers = $query->withCount('orders')->latest()->paginate(18);
        $totalCustomers = Customer::count();
        $activeProjects = Project::where('status', 'aktif')->count();

        // Pelanggan terpilih untuk sidebar (pertama di list)
        $featured = $customers->first() ? $customers->first()->load(['orders.items.product']) : null;

        // Semua data pelanggan untuk sidebar (JSON)
        $customersData = $customers->map(function ($c) {
            $c->load(['orders.items.product']);

            return [
                'id' => $c->id,
                'nama' => $c->nama,
                'initials' => $c->initials,
                'jabatan' => $c->jabatan,
                'perusahaan' => $c->perusahaan,
                'kota' => $c->kota,
                'provinsi' => $c->provinsi,
                'email' => $c->email,
                'telepon' => $c->telepon,
                'status_loyalitas' => $c->status_loyalitas,
                'orders_count' => $c->orders_count,
                'orders' => $c->orders->sortByDesc('tanggal_pesanan')->take(3)->map(function ($o) {
                    return [
                        'id' => $o->id,
                        'produk' => $o->items->first()?->product?->nama_produk ?? 'Pesanan',
                        'total_format' => $o->total_format,
                        'status_label' => $o->status_label,
                        'tanggal' => $o->tanggal_pesanan->translatedFormat('d M Y'),
                    ];
                })->values(),
            ];
        })->values();

        return view('pages.customers', [
            'activePage' => 'customers',
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'activeProjects' => $activeProjects,
            'featured' => $featured,
            'customersData' => $customersData,
        ]);
    }

    public function create()
    {
        return view('pages.clients.create', ['activePage' => 'customers']);
    }

    /**
     * Store — Simpan pelanggan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'telepon' => 'nullable|string|max:20',
            'perusahaan' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'status_loyalitas' => 'required|in:baru,reguler,vip',
            'catatan' => 'nullable|string',
        ]);

        $customer = Customer::create($request->only([
            'nama', 'email', 'telepon', 'perusahaan', 'jabatan',
            'alamat', 'kota', 'provinsi', 'kode_pos',
            'status_loyalitas', 'catatan',
        ]));

        return redirect()
            ->route('clients.show', $customer->id)
            ->with('success', 'Pelanggan "'.$customer->nama.'" berhasil ditambahkan!');
    }

    public function show($id)
    {
        $customer = Customer::with(['orders.items.product', 'projects'])->findOrFail($id);

        // Hitung total nilai seumur hidup
        $lifetimeValue = $customer->orders->sum('total');

        return view('pages.clients.show', [
            'activePage' => 'customers',
            'customer' => $customer,
            'lifetimeValue' => $lifetimeValue,
        ]);
    }

    public function edit($id)
    {
        $customer = Customer::with(['orders.items.product'])->findOrFail($id);

        // Hitung total nilai seumur hidup
        $lifetimeValue = $customer->orders->sum('total');

        return view('pages.clients.edit', [
            'activePage' => 'customers',
            'customer' => $customer,
            'lifetimeValue' => $lifetimeValue,
        ]);
    }

    /**
     * Update — Update pelanggan
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,'.$id,
            'telepon' => 'nullable|string|max:20',
            'perusahaan' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'status_loyalitas' => 'required|in:baru,reguler,vip',
            'catatan' => 'nullable|string',
        ]);

        $customer->update($request->only([
            'nama', 'email', 'telepon', 'perusahaan', 'jabatan',
            'alamat', 'kota', 'provinsi', 'kode_pos',
            'status_loyalitas', 'catatan',
        ]));

        return redirect()
            ->route('clients.show', $customer->id)
            ->with('success', 'Pelanggan "'.$customer->nama.'" berhasil diperbarui!');
    }

    /**
     * Destroy — Soft-delete pelanggan
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $nama = $customer->nama;

        // Cek apakah ada order aktif
        $activeOrders = $customer->orders()
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->count();

        if ($activeOrders > 0) {
            return redirect()
                ->route('clients.edit', $id)
                ->with('error', 'Tidak dapat menghapus pelanggan yang masih memiliki '.$activeOrders.' pesanan aktif.');
        }

        $customer->delete(); // soft-delete

        return redirect()
            ->route('customers')
            ->with('success', 'Pelanggan "'.$nama.'" berhasil dihapus!');
    }
}
