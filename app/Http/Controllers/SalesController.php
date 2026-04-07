<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items.product']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        // Filter by priority
        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        // Search by invoice number or customer name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_faktur', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($cq) use ($search) {
                        $cq->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Sort
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->oldest('tanggal_pesanan');
        } elseif ($sort === 'terbesar') {
            $query->orderBy('total', 'desc');
        } elseif ($sort === 'terkecil') {
            $query->orderBy('total', 'asc');
        } else {
            $query->latest('tanggal_pesanan');
        }

        $orders = $query->paginate(18);

        $todayRevenue = Payment::whereDate('tanggal_bayar', today())->sum('jumlah');
        $totalTransactions = Order::count();
        $totalProspek = Order::where('status', 'prospek')->count();
        $totalDalamProduksi = Order::where('status', 'dalam_produksi')->count();
        $totalSelesai = Order::where('status', 'selesai')->count();
        $totalDibatalkan = Order::where('status', 'dibatalkan')->count();

        return view('pages.sales', [
            'activePage' => 'sales',
            'orders' => $orders,
            'todayRevenue' => $todayRevenue,
            'totalTransactions' => $totalTransactions,
            'totalProspek' => $totalProspek,
            'totalDalamProduksi' => $totalDalamProduksi,
            'totalSelesai' => $totalSelesai,
            'totalDibatalkan' => $totalDibatalkan,
        ]);
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $products = Product::with('coverImage')
            ->where('visibilitas', 'aktif')
            ->orderBy('nama_produk')
            ->get();

        return view('pages.orders.create', [
            'activePage' => 'sales',
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    /**
     * Store — Buat pesanan baru dengan order items
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal_pesanan' => 'required|date',
            'estimasi_pengiriman' => 'nullable|date|after_or_equal:tanggal_pesanan',
            'prioritas' => 'required|in:standar,cepat,express',
            'metode_pembayaran' => 'required|in:transfer_bank,kartu_kredit,dp_pelunasan',
            'alamat_pengiriman' => 'nullable|string',
            'catatan' => 'nullable|string',
            'pajak_persen' => 'nullable|numeric|min:0|max:100',
            'ongkir' => 'nullable|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.kustomisasi' => 'nullable|string',
        ]);

        // Hitung subtotal dari items
        $subtotal = 0;
        $itemsData = [];
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $hargaSatuan = $product->harga;
            $itemSubtotal = $hargaSatuan * $item['jumlah'];
            $subtotal += $itemSubtotal;

            $itemsData[] = [
                'product_id' => $item['product_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $hargaSatuan,
                'subtotal' => $itemSubtotal,
                'kustomisasi' => $item['kustomisasi'] ?? null,
            ];
        }

        $pajakPersen = $request->pajak_persen ?? 0;
        $pajak = $subtotal * ($pajakPersen / 100);
        $ongkir = $request->ongkir ?? 0;
        $diskon = $request->diskon ?? 0;
        $total = $subtotal + $pajak + $ongkir - $diskon;

        // Generate nomor faktur
        $lastOrder = Order::withTrashed()->latest('id')->first();
        $nextNum = $lastOrder ? ($lastOrder->id + 1) : 1;
        $nomorFaktur = 'INV-'.str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'nomor_faktur' => $nomorFaktur,
            'customer_id' => $request->customer_id,
            'user_id' => 1, // TODO: auth()->id()
            'tanggal_pesanan' => $request->tanggal_pesanan,
            'subtotal' => $subtotal,
            'pajak_persen' => $pajakPersen,
            'pajak' => $pajak,
            'ongkir' => $ongkir,
            'diskon' => $diskon,
            'total' => $total,
            'status' => 'prospek',
            'prioritas' => $request->prioritas,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'belum_bayar',
            'estimasi_pengiriman' => $request->estimasi_pengiriman,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'catatan' => $request->catatan,
        ]);

        // Simpan order items
        foreach ($itemsData as $itemData) {
            $order->items()->create($itemData);
        }

        return redirect()
            ->route('sales.show', $order->id)
            ->with('success', 'Pesanan #'.$nomorFaktur.' berhasil dibuat!');
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product.coverImage', 'payments', 'project.milestones'])->findOrFail($id);

        return view('pages.sales.show', [
            'activePage' => 'sales',
            'order' => $order,
        ]);
    }

    public function edit($id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        $customers = Customer::orderBy('nama')->get();
        $products = Product::with('coverImage')
            ->where('visibilitas', 'aktif')
            ->orderBy('nama_produk')
            ->get();

        return view('pages.orders.edit', [
            'activePage' => 'sales',
            'order' => $order,
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    /**
     * Update — Update pesanan + recalculate totals
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal_pesanan' => 'required|date',
            'estimasi_pengiriman' => 'nullable|date',
            'prioritas' => 'required|in:standar,cepat,express',
            'metode_pembayaran' => 'required|in:transfer_bank,kartu_kredit,dp_pelunasan',
            'status' => 'required|in:prospek,dalam_produksi,dikirim,selesai,dibatalkan',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
            'alamat_pengiriman' => 'nullable|string',
            'catatan' => 'nullable|string',
            'pajak_persen' => 'nullable|numeric|min:0|max:100',
            'ongkir' => 'nullable|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.kustomisasi' => 'nullable|string',
        ]);

        // Recalculate
        $subtotal = 0;
        $itemsData = [];
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $hargaSatuan = $product->harga;
            $itemSubtotal = $hargaSatuan * $item['jumlah'];
            $subtotal += $itemSubtotal;

            $itemsData[] = [
                'product_id' => $item['product_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $hargaSatuan,
                'subtotal' => $itemSubtotal,
                'kustomisasi' => $item['kustomisasi'] ?? null,
            ];
        }

        $pajakPersen = $request->pajak_persen ?? 0;
        $pajak = $subtotal * ($pajakPersen / 100);
        $ongkir = $request->ongkir ?? 0;
        $diskon = $request->diskon ?? 0;
        $total = $subtotal + $pajak + $ongkir - $diskon;

        $order->update([
            'customer_id' => $request->customer_id,
            'tanggal_pesanan' => $request->tanggal_pesanan,
            'subtotal' => $subtotal,
            'pajak_persen' => $pajakPersen,
            'pajak' => $pajak,
            'ongkir' => $ongkir,
            'diskon' => $diskon,
            'total' => $total,
            'status' => $request->status,
            'prioritas' => $request->prioritas,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'estimasi_pengiriman' => $request->estimasi_pengiriman,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'catatan' => $request->catatan,
        ]);

        // Re-sync order items
        $order->items()->delete();
        foreach ($itemsData as $itemData) {
            $order->items()->create($itemData);
        }

        return redirect()
            ->route('sales.show', $order->id)
            ->with('success', 'Pesanan #'.$order->nomor_faktur.' berhasil diperbarui!');
    }

    /**
     * Destroy — Soft-delete pesanan
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $nomorFaktur = $order->nomor_faktur;
        $order->delete(); // soft-delete

        return redirect()
            ->route('sales')
            ->with('success', 'Pesanan #'.$nomorFaktur.' berhasil dihapus!');
    }

    public function saveFeedback(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'rating' => $request->rating,
            'keluhan_masukan' => $request->keluhan_masukan,
        ]);
        return redirect()->route('sales.show', $id)->with('success', 'Penilaian berhasil disimpan.');
    }
}
