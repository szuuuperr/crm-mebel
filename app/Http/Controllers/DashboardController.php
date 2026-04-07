<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Project;
use App\Models\WoodType;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total pendapatan dari semua order selesai/dikirim
        $totalPendapatanOrder = Order::whereIn('status', ['selesai', 'dikirim', 'dalam_produksi'])->sum('total');
        // Total pendapatan proyek
        $totalPendapatanProject = Project::whereIn('status', ['aktif', 'selesai'])->sum('anggaran');
        $totalPendapatan = $totalPendapatanOrder + $totalPendapatanProject;

        // Proyek aktif
        $proyekAktif = Project::where('status', 'aktif')->count();
        $orderAktif = Order::whereNotIn('status', ['selesai', 'dibatalkan'])->count();

        // Proyek mendekati deadline
        $nearDeadline = Project::where('status', 'aktif')
            ->where('target_selesai', '<=', now()->addDays(7))
            ->count();

        // Proyek berjalan (dengan customer & order)
        $projects = Project::where('status', 'aktif')
            ->with(['customer', 'order'])
            ->latest()
            ->take(3)
            ->get();

        // Permintaan terbaru (order terbaru)
        $recentOrders = Order::with(['customer', 'items.product'])
            ->latest()
            ->take(3)
            ->get();

        // Stok bahan baku dari wood_types dan products
        $woodTypes = WoodType::withCount('products')->get();
        $lowStockProducts = Product::where('stok', '<=', 5)->count();

        // Notifikasi belum dibaca
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->whereNull('dibaca_pada')
            ->count();

        // Pendapatan per hari dalam minggu ini
        $chartData = [];
        $days = ['SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB', 'MIN'];
        $startOfWeek = now()->startOfWeek();

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $sales = (float) Order::whereDate('tanggal_pesanan', $date)->sum('total');
            $project = (float) Project::whereDate('tanggal_mulai', $date)->sum('anggaran');
            $chartData[] = [
                'label' => $days[$i], 
                'sales_value' => $sales,
                'project_value' => $project,
                'total_value' => $sales + $project
            ];
        }

        // Pendapatan per bulan (12 bulan terakhir)
        $monthlyChartData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->copy()->subMonths($i);
            $sales = (float) Order::whereYear('tanggal_pesanan', $month->year)
                ->whereMonth('tanggal_pesanan', $month->month)
                ->sum('total');
            $project = (float) Project::whereYear('tanggal_mulai', $month->year)
                ->whereMonth('tanggal_mulai', $month->month)
                ->sum('anggaran');
                
            $monthlyChartData[] = [
                'label' => $months[$month->month - 1],
                'sales_value' => $sales,
                'project_value' => $project,
                'total_value' => $sales + $project,
                'month' => $month->month,
                'year' => $month->year,
            ];
        }

        // Total data untuk export
        $totalExportData = Order::count() + Product::count() + Customer::count();

        return view('pages.dashboard', [
            'activePage' => 'dashboard',
            'totalPendapatan' => $totalPendapatan,
            'orderAktif' => $orderAktif,
            'nearDeadline' => $nearDeadline,
            'projects' => $projects,
            'recentOrders' => $recentOrders,
            'chartData' => $chartData,
            'monthlyChartData' => $monthlyChartData,
            'woodTypes' => $woodTypes,
            'lowStockProducts' => $lowStockProducts,
            'unreadNotifications' => $unreadNotifications,
            'totalExportData' => $totalExportData,
        ]);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $q = $request->input('q');
        $results = [
            'projects' => Project::where('nama', 'like', "%{$q}%")->with('customer')->take(5)->get(),
            'products' => Product::where('nama_produk', 'like', "%{$q}%")->take(5)->get(),
            'customers' => Customer::where('nama', 'like', "%{$q}%")->orWhere('perusahaan', 'like', "%{$q}%")->take(5)->get(),
            'orders' => Order::where('nomor_faktur', 'like', "%{$q}%")->with('customer')->take(5)->get(),
        ];

        return response()->json($results);
    }
}
