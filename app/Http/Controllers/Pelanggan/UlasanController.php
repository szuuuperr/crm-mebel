<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            return view('pelanggan.ulasan.index', [
                'activePage' => 'ulasan',
                'reviewables' => collect(),
            ]);
        }

        $customerId = $customer->id;

        // Ambil semua order & proyek selesai milik pelanggan
        $orders = Order::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->latest()
            ->get()
            ->map(function ($order) {
                return (object) [
                    'id' => $order->id,
                    'type' => 'order',
                    'label' => 'Pesanan',
                    'nomor' => $order->nomor_faktur,
                    'nama' => 'Pesanan #' . $order->nomor_faktur,
                    'tanggal' => $order->tanggal_pesanan,
                    'rating' => $order->rating,
                    'keluhan_masukan' => $order->keluhan_masukan,
                    'sudah_direview' => ! empty($order->rating),
                ];
            });

        $projects = Project::where('customer_id', $customerId)
            ->where('status', 'selesai')
            ->latest()
            ->get()
            ->map(function ($project) {
                return (object) [
                    'id' => $project->id,
                    'type' => 'project',
                    'label' => 'Proyek',
                    'nomor' => $project->nomor_faktur,
                    'nama' => $project->nama,
                    'tanggal' => $project->tanggal_selesai ?? $project->updated_at,
                    'rating' => $project->rating,
                    'keluhan_masukan' => $project->keluhan_masukan,
                    'sudah_direview' => ! empty($project->rating),
                ];
            });

        $reviewables = $orders->concat($projects)->sortByDesc('tanggal')->values();

        return view('pelanggan.ulasan.index', [
            'activePage' => 'ulasan',
            'reviewables' => $reviewables,
        ]);
    }

    public function create(string $type, int $id)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            abort(404);
        }

        $reviewable = $this->resolveReviewable($type, $id, $customer->id);

        if (! $reviewable) {
            abort(404);
        }

        // Harus status selesai dan belum di-review
        if ($reviewable->status !== 'selesai' || ! empty($reviewable->rating)) {
            return redirect()->route('pelanggan.ulasan.index')
                ->with('error', 'Ulasan tidak tersedia untuk item ini.');
        }

        return view('pelanggan.ulasan.create', [
            'activePage' => 'ulasan',
            'reviewable' => $reviewable,
            'type' => $type,
        ]);
    }

    public function store(Request $request, string $type, int $id)
    {
        $customer = Auth::user()->customer;

        if (! $customer) {
            abort(404);
        }

        $reviewable = $this->resolveReviewable($type, $id, $customer->id);

        if (! $reviewable) {
            abort(404);
        }

        if ($reviewable->status !== 'selesai' || ! empty($reviewable->rating)) {
            return redirect()->route('pelanggan.ulasan.index')
                ->with('error', 'Ulasan tidak tersedia untuk item ini.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'keluhan_masukan' => 'required|string|min:10|max:2000',
        ], [
            'rating.required' => 'Silakan pilih rating bintang.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
            'keluhan_masukan.required' => 'Tuliskan ulasan atau masukan Anda.',
            'keluhan_masukan.min' => 'Ulasan minimal 10 karakter.',
            'keluhan_masukan.max' => 'Ulasan maksimal 2000 karakter.',
        ]);

        $reviewable->update([
            'rating' => $validated['rating'],
            'keluhan_masukan' => $validated['keluhan_masukan'],
        ]);

        return redirect()->route('pelanggan.ulasan.index')
            ->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }

    protected function resolveReviewable(string $type, int $id, int $customerId)
    {
        if ($type === 'order') {
            return Order::where('customer_id', $customerId)->find($id);
        }

        if ($type === 'project') {
            return Project::where('customer_id', $customerId)->find($id);
        }

        return null;
    }
}
