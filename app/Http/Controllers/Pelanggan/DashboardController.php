<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            return view('pelanggan.dashboard', [
                'activePage' => 'dashboard',
                'pesananAktif' => 0,
                'proyekAktif' => 0,
                'pesananSelesai' => 0,
                'proyekSelesai' => 0,
                'belumDireview' => 0,
                'recentOrders' => collect(),
                'recentProjects' => collect(),
            ]);
        }

        $customerId = $customer->id;

        $pesananAktif = Order::where('customer_id', $customerId)
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->count();

        $proyekAktif = Project::where('customer_id', $customerId)
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->count();

        $pesananSelesai = Order::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->count();

        $proyekSelesai = Project::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->count();

        // Hitung order/proyek selesai yang belum di-review
        $belumDireviewOrder = Order::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->whereNull('rating')
            ->count();

        $belumDireviewProyek = Project::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->whereNull('rating')
            ->count();

        $belumDireview = $belumDireviewOrder + $belumDireviewProyek;

        $recentOrders = Order::where('customer_id', $customerId)
            ->with('items.product')
            ->latest()
            ->take(5)
            ->get();

        $recentProjects = Project::where('customer_id', $customerId)
            ->latest()
            ->take(5)
            ->get();

        return view('pelanggan.dashboard', [
            'activePage' => 'dashboard',
            'pesananAktif' => $pesananAktif,
            'proyekAktif' => $proyekAktif,
            'pesananSelesai' => $pesananSelesai,
            'proyekSelesai' => $proyekSelesai,
            'belumDireview' => $belumDireview,
            'recentOrders' => $recentOrders,
            'recentProjects' => $recentProjects,
        ]);
    }
}
