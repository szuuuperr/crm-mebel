@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
    <!-- Content Canvas -->
    <div class="pt-28 px-10 pb-12">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-400 text-white rounded-lg font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Header & Quick Stats -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight">Buku Penjualan</h2>
                <p class="text-on-surface-variant mt-2 font-medium">Melacak setiap transaksi kerajinan artisan</p>
            </div>
            <div class="flex gap-4">
                <a class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 shadow-lg shadow-primary/10 hover:scale-105 transition-transform"
                    href="{{ route('orders.create') }}">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Buat Pesanan Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Pesanan</p>
                <h3 class="text-3xl font-black text-primary">{{ $totalTransactions }}</h3>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Prospek</p>
                <h3 class="text-3xl font-black text-primary">{{ $totalProspek }}</h3>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Dalam Produksi</p>
                <h3 class="text-3xl font-black text-primary">{{ $totalDalamProduksi }}</h3>
            </div>
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Selesai</p>
                <h3 class="text-3xl font-black text-primary">{{ $totalSelesai }}</h3>
            </div>
        </div>
        <!-- Filters Bar -->
        <form action="{{ route('sales') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('sales') }}"
                    class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ !request()->hasAny(['status', 'status_pembayaran', 'prioritas', 'search', 'sort']) ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                    Semua Pesanan
                </a>
                <a href="{{ route('sales', array_merge(request()->except('page'), ['status' => 'dalam_produksi'])) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'dalam_produksi' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                    Dalam Produksi
                </a>
                <a href="{{ route('sales', array_merge(request()->except('page'), ['status' => 'dikirim'])) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'dikirim' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                    Dikirim
                </a>
                <a href="{{ route('sales', array_merge(request()->except('page'), ['status' => 'selesai'])) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'selesai' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                    Selesai
                </a>
            </div>
            <div class="ml-auto flex items-center gap-3">
                <select name="status_pembayaran" onchange="this.form.submit()"
                    class="px-4 py-2.5 w-48 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                    <option value="">Semua Pembayaran</option>
                    <option value="belum_bayar" {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum
                        Bayar</option>
                    <option value="dp" {{ request('status_pembayaran') == 'dp' ? 'selected' : '' }}>DP</option>
                    <option value="lunas" {{ request('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
                <select name="sort" onchange="this.form.submit()"
                    class="px-4 py-2.5 w-48 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    <option value="terbesar" {{ request('sort') == 'terbesar' ? 'selected' : '' }}>Total Terbesar</option>
                    <option value="terkecil" {{ request('sort') == 'terkecil' ? 'selected' : '' }}>Total Terkecil</option>
                </select>
            </div>
        </form>

        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'status_pembayaran', 'sort']))
            <div class="flex items-center gap-2 mb-6 flex-wrap">
                <span class="text-xs font-bold text-outline uppercase">Filter Aktif:</span>
                @if(request('search'))
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                        Cari: "{{ request('search') }}"
                        <a href="{{ route('sales', request()->except(['search', 'page'])) }}" class="hover:text-error">&times;</a>
                    </span>
                @endif
                @if(request('status_pembayaran'))
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                        Pembayaran: {{ str_replace('_', ' ', ucfirst(request('status_pembayaran'))) }}
                        <a href="{{ route('sales', request()->except(['status_pembayaran', 'page'])) }}"
                            class="hover:text-error">&times;</a>
                    </span>
                @endif
                @if(request('sort') && request('sort') !== 'terbaru')
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                        Urutkan: {{ str_replace('_', ' ', ucfirst(request('sort'))) }}
                        <a href="{{ route('sales', request()->except(['sort', 'page'])) }}" class="hover:text-error">&times;</a>
                    </span>
                @endif
                @if(request()->hasAny(['search', 'status_pembayaran', 'sort']))
                    <a href="{{ route('sales') }}" class="px-3 py-1 text-xs font-bold text-error hover:underline">Reset Semua</a>
                @endif
            </div>
        @endif

        <!-- Transactions Table -->
        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead class="text-on-surface-variant/60">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Faktur</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Detail Barang</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Jumlah</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-center">Status</th>
                        <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse($orders as $order)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-8 py-6">
                                <span class="font-headline font-bold text-primary">#{{ $order->nomor_faktur }}</span>
                                <p class="text-xs text-outline mt-0.5">{{ $order->tanggal_pesanan->translatedFormat('d M Y') }}
                                </p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-[10px] font-bold text-on-primary-container">
                                        {{ $order->customer->initials }}
                                    </div>
                                    <span class="font-medium text-on-surface">{{ $order->customer->nama }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="text-sm font-semibold block">{{ $order->items->first()?->product?->nama_produk ?? '-' }}</span>
                                <span
                                    class="text-xs text-on-surface-variant">{{ $order->items->count() > 1 ? '+' . ($order->items->count() - 1) . ' item lainnya' : ($order->items->first()?->kustomisasi ?? '') }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-headline font-bold text-primary">{{ $order->total_format }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $order->status_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('sales.show', $order->id) }}"
                                    class="text-outline hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center">
                                <span class="material-symbols-outlined text-5xl text-outline/30 mb-3">receipt_long</span>
                                <p class="text-lg font-bold text-on-surface-variant">Tidak ada transaksi yang ditemukan.</p>
                                @if(request()->hasAny(['status', 'status_pembayaran', 'search']))
                                    <a href="{{ route('sales') }}"
                                        class="mt-3 inline-block text-primary font-bold hover:underline">Reset Filter</a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if($orders->hasPages())
                <div class="px-8 py-6 bg-surface-container-low flex justify-between items-center">
                    <p class="text-sm text-on-surface-variant font-medium">Menampilkan
                        {{ $orders->firstItem() }}-{{ $orders->lastItem() }} dari {{ $orders->total() }} transaksi</p>
                    <div class="flex gap-2">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Export Section -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-2 bg-primary p-12 rounded-xl text-on-primary relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold mb-4">Ekspor Catatan Kerajinan</h3>
                    <p class="text-on-primary-container max-w-md mb-8">Unduh laporan CSV atau PDF resolusi tinggi untuk
                        dokumentasi pajak dan perencanaan produksi.</p>
                    <div class="flex gap-4">
                        <button onclick="openModal('modal-export')"
                            class="bg-secondary-container text-on-secondary-container px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform flex items-center gap-2">
                            <span class="material-symbols-outlined">download</span>
                            CSV Keuangan
                        </button>
                        <button onclick="openModal('modal-export')"
                            class="bg-primary-container text-on-primary-container border border-outline-variant/30 px-8 py-3 rounded-full font-bold hover:bg-primary-container/80 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined">description</span>
                            PDF Proyek
                        </button>
                    </div>
                </div>
                <div
                    class="absolute -bottom-24 -right-24 w-64 h-64 bg-surface-tint/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700">
                </div>
            </div>
            <div class="bg-surface-container-high p-8 rounded-xl flex flex-col justify-between">
                <div>
                    <span class="material-symbols-outlined text-primary text-4xl mb-4"
                        style="font-variation-settings: 'FILL' 1;">trending_up</span>
                    <h4 class="text-xl font-bold text-primary mb-2">Proyeksi Kuartalan</h4>
                    <p class="text-sm text-on-surface-variant">Berdasarkan kecepatan produksi saat ini, kami 12% lebih
                        unggul dari siklus pasokan walnut tahun lalu.</p>
                </div>
                <div class="mt-6 pt-6 border-t border-outline-variant/20">
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-bold uppercase text-outline">Target Tercapai</span>
                        <span class="text-lg font-bold text-primary">82%</span>
                    </div>
                    <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full" style="width: 82%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @include('components.modal-export')
@endsection