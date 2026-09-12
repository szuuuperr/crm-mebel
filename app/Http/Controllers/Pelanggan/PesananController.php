<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            return view('pelanggan.pesanan.index', [
                'activePage' => 'pesanan',
                'orders' => collect(),
            ]);
        }

        $query = Order::where('customer_id', $customer->id)
            ->with('items.product');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by nomor faktur
        if ($request->filled('search')) {
            $query->where('nomor_faktur', 'like', "%{$request->search}%");
        }

        $orders = $query->latest('tanggal_pesanan')->paginate(15)->withQueryString();

        return view('pelanggan.pesanan.index', [
            'activePage' => 'pesanan',
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            abort(404);
        }

        $order = Order::where('customer_id', $customer->id)
            ->with(['items.product.coverImage', 'payments', 'project.milestones'])
            ->findOrFail($id);

        return view('pelanggan.pesanan.show', [
            'activePage' => 'pesanan',
            'order' => $order,
        ]);
    }
}
