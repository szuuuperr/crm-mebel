@extends('layouts.pelanggan')

@section('title', 'Pesanan Saya')
@section('page-title', 'Pesanan Saya')
@section('page-subtitle', 'Daftar dan status semua pesanan Anda')

@section('content')
    {{-- Filter --}}
    <form method="GET" action="{{ route('pelanggan.pesanan.index') }}" class="mb-8">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-xl">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor faktur..."
                        class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant/30 rounded-xl text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all" />
                </div>
            </div>
            <select name="status" class="bg-white border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Status</option>
                <option value="prospek" {{ request('status') == 'prospek' ? 'selected' : '' }}>Prospek Baru</option>
                <option value="dalam_produksi" {{ request('status') == 'dalam_produksi' ? 'selected' : '' }}>Dalam Produksi</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold text-sm rounded-xl hover:bg-primary-container transition-colors">
                Filter
            </button>
        </div>
    </form>

    {{-- Orders List --}}
    @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <a href="{{ route('pelanggan.pesanan.show', $order->id) }}"
                   class="block bg-white rounded-2xl border border-outline-variant/20 p-6 hover:shadow-lg hover:border-primary/30 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">receipt_long</span>
                            <div>
                                <h3 class="text-base font-bold text-on-surface font-headline">{{ $order->nomor_faktur }}</h3>
                                <p class="text-xs text-on-surface-variant">{{ $order->tanggal_pesanan->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 text-xs font-bold rounded-full {{ $order->status_class }}">
                                {{ $order->status_label }}
                            </span>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_right</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-4 text-on-surface-variant">
                            <span>{{ $order->items->count() }} item</span>
                            @if($order->estimasi_pengiriman)
                                <span>• Est. {{ $order->estimasi_pengiriman->format('d M Y') }}</span>
                            @endif
                        </div>
                        <p class="text-lg font-extrabold text-primary font-headline">{{ $order->total_format }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-outline/30 mb-4">receipt_long</span>
            <p class="text-on-surface-variant font-medium">Belum ada pesanan.</p>
        </div>
    @endif
@endsection
