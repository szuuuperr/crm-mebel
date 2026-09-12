<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                'has_account' => $c->user_id !== null,
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
     * Store — Simpan pelanggan baru + buat akun login jika diminta
     */
    public function store(Request $request)
    {
        $rules = [
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
        ];

        // Validasi akun login jika checkbox aktif
        if ($request->has('buat_akun')) {
            $rules['akun_email'] = 'required|email|unique:users,email';
            $rules['akun_password'] = 'required|string|min:8';
        }

        $request->validate($rules);

        $customerData = $request->only([
            'nama', 'email', 'telepon', 'perusahaan', 'jabatan',
            'alamat', 'kota', 'provinsi', 'kode_pos',
            'status_loyalitas', 'catatan',
        ]);

        // Buat akun user jika diminta
        if ($request->has('buat_akun')) {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->akun_email,
                'password' => Hash::make($request->akun_password),
                'role' => 'pelanggan',
            ]);
            $customerData['user_id'] = $user->id;
        }

        $customer = Customer::create($customerData);

        return redirect()
            ->route('clients.show', $customer->id)
            ->with('success', 'Pelanggan "'.$customer->nama.'" berhasil ditambahkan!'
                .($request->has('buat_akun') ? ' Akun login telah dibuat.' : ''));
    }

    public function show($id)
    {
        $customer = Customer::with(['orders.items.product', 'projects', 'user'])->findOrFail($id);

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
        $customer = Customer::with(['orders.items.product', 'user'])->findOrFail($id);

        // Hitung total nilai seumur hidup
        $lifetimeValue = $customer->orders->sum('total');

        return view('pages.clients.edit', [
            'activePage' => 'customers',
            'customer' => $customer,
            'lifetimeValue' => $lifetimeValue,
        ]);
    }

    /**
     * Update — Update pelanggan + kelola akun login
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $rules = [
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
        ];

        // Jika belum punya akun dan ingin buat
        if ($request->has('buat_akun') && !$customer->user_id) {
            $rules['akun_email'] = 'required|email|unique:users,email';
            $rules['akun_password'] = 'required|string|min:8';
        }

        // Jika sudah punya akun dan ingin update password
        if ($request->filled('akun_password_baru') && $customer->user_id) {
            $rules['akun_password_baru'] = 'string|min:8';
        }

        $request->validate($rules);

        $customer->update($request->only([
            'nama', 'email', 'telepon', 'perusahaan', 'jabatan',
            'alamat', 'kota', 'provinsi', 'kode_pos',
            'status_loyalitas', 'catatan',
        ]));

        // Buat akun baru jika diminta dan belum ada
        if ($request->has('buat_akun') && !$customer->user_id) {
            $user = User::create([
                'name' => $customer->nama,
                'email' => $request->akun_email,
                'password' => Hash::make($request->akun_password),
                'role' => 'pelanggan',
            ]);
            $customer->update(['user_id' => $user->id]);
        }

        // Update password akun yang sudah ada
        if ($request->filled('akun_password_baru') && $customer->user_id) {
            $customer->user->update([
                'password' => Hash::make($request->akun_password_baru),
            ]);
        }

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
