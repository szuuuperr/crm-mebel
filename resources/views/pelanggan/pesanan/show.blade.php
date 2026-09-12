@extends('layouts.pelanggan')

@section('title', 'Detail Pesanan ' . $order->nomor_faktur)
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', $order->nomor_faktur)

@section('content')
    {{-- Back --}}
    <a href="{{ route('pelanggan.pesanan.index') }}" class="inline-flex items-center gap-2 text-sm text-on-surface-variant hover:text-primary transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Kembali ke Pesanan
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Status & Info Card --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-on-surface font-headline">{{ $order->nomor_faktur }}</h2>
                        <p class="text-sm text-on-surface-variant">Tanggal: {{ $order->tanggal_pesanan->format('d M Y') }}</p>
                    </div>
                    <span class="px-5 py-2 text-sm font-bold rounded-full {{ $order->status_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>

                {{-- Status Timeline --}}
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-on-surface uppercase tracking-wider mb-4">Progress Pesanan</h3>
                    @php
                        $statuses = ['prospek', 'dalam_produksi', 'dikirim', 'selesai'];
                        $statusLabels = ['Prospek', 'Produksi', 'Dikirim', 'Selesai'];
                        $statusIcons = ['fiber_new', 'precision_manufacturing', 'local_shipping', 'check_circle'];
                        $currentIndex = array_search($order->status, $statuses);
                        if ($order->status === 'dibatalkan') $currentIndex = -1;
                    @endphp
                    <div class="flex items-center justify-between">
                        @foreach($statuses as $i => $status)
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $i <= $currentIndex ? 'bg-primary text-on-primary' : 'bg-surface-container text-outline' }} transition-colors">
                                    <span class="material-symbols-outlined text-lg">{{ $statusIcons[$i] }}</span>
                                </div>
                                <p class="text-xs font-bold mt-2 {{ $i <= $currentIndex ? 'text-primary' : 'text-outline' }}">{{ $statusLabels[$i] }}</p>
                            </div>
                            @if($i < count($statuses) - 1)
                                <div class="flex-1 h-1 {{ $i < $currentIndex ? 'bg-primary' : 'bg-surface-container' }} rounded-full mx-1 -mt-6"></div>
                            @endif
                        @endforeach
                    </div>
                    @if($order->status === 'dibatalkan')
                        <div class="mt-4 p-3 bg-red-50 rounded-xl text-sm text-red-700 font-medium text-center">
                            Pesanan ini telah dibatalkan
                        </div>
                    @endif
                </div>
            </div>

            {{-- Items --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/20">
                    <h3 class="font-bold text-on-surface font-headline">Item Pesanan</h3>
                </div>
                <div class="divide-y divide-outline-variant/10">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4 p-4">
                            <div class="w-16 h-16 bg-surface-container rounded-xl overflow-hidden flex-shrink-0">
                                @if($item->product && $item->product->coverImage)
                                    <img src="{{ $item->product->coverImage->path }}" alt="" class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-outline/30">chair</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-on-surface">{{ $item->product->nama_produk ?? 'Produk tidak tersedia' }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $item->jumlah }} × Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                @if($item->kustomisasi)
                                    <p class="text-xs text-on-surface-variant italic mt-1">Kustom: {{ $item->kustomisasi }}</p>
                                @endif
                            </div>
                            <p class="text-sm font-bold text-on-surface">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Review CTA --}}
            @if($order->status === 'selesai' && empty($order->rating))
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-200/50 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-600 text-2xl">rate_review</span>
                            <div>
                                <h3 class="font-bold text-on-surface">Berikan Ulasan</h3>
                                <p class="text-xs text-on-surface-variant">Pesanan telah selesai. Beri masukan untuk kami!</p>
                            </div>
                        </div>
                        <a href="{{ route('pelanggan.ulasan.create', ['type' => 'order', 'id' => $order->id]) }}"
                           class="px-6 py-3 bg-primary text-on-primary font-bold text-sm rounded-full hover:bg-primary-container transition-colors">
                            Tulis Ulasan
                        </a>
                    </div>
                </div>
            @elseif(!empty($order->rating))
                <div class="bg-emerald-50 rounded-2xl border border-emerald-200/50 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                        <h3 class="font-bold text-emerald-800">Ulasan Anda</h3>
                    </div>
                    <div class="flex items-center gap-1 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-lg {{ $i <= $order->rating ? 'text-amber-500' : 'text-outline/30' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                        <span class="text-sm font-bold text-on-surface ml-2">{{ $order->rating }}/5</span>
                    </div>
                    @if($order->keluhan_masukan)
                        <p class="text-sm text-on-surface-variant italic">"{{ $order->keluhan_masukan }}"</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-6">
            {{-- Payment Summary --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <h3 class="font-bold text-on-surface font-headline mb-4">Ringkasan Pembayaran</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @if($order->pajak > 0)
                        <div class="flex justify-between text-on-surface-variant">
                            <span>Pajak ({{ $order->pajak_persen }}%)</span>
                            <span>Rp {{ number_format($order->pajak, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if($order->ongkir > 0)
                        <div class="flex justify-between text-on-surface-variant">
                            <span>Ongkir</span>
                            <span>Rp {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if($order->diskon > 0)
                        <div class="flex justify-between text-emerald-600">
                            <span>Diskon</span>
                            <span>-Rp {{ number_format($order->diskon, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="border-t border-outline-variant/20 pt-3 flex justify-between font-extrabold text-on-surface text-lg">
                        <span>Total</span>
                        <span class="text-primary">{{ $order->total_format }}</span>
                    </div>
                </div>
            </div>

            {{-- Order Details --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <h3 class="font-bold text-on-surface font-headline mb-4">Detail Pesanan</h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Prioritas</p>
                        <p class="font-bold text-on-surface capitalize">{{ str_replace('_', ' ', $order->prioritas) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Pembayaran</p>
                        <p class="font-bold text-on-surface capitalize">{{ str_replace('_', ' ', $order->metode_pembayaran ?? '-') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Status Pembayaran</p>
                        <p class="font-bold text-on-surface capitalize">{{ str_replace('_', ' ', $order->status_pembayaran) }}</p>
                    </div>
                    @if($order->estimasi_pengiriman)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Estimasi Pengiriman</p>
                            <p class="font-bold text-on-surface">{{ $order->estimasi_pengiriman->format('d M Y') }}</p>
                        </div>
                    @endif
                    @if($order->alamat_pengiriman)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                            <p class="text-on-surface">{{ $order->alamat_pengiriman }}</p>
                        </div>
                    @endif
                    @if($order->catatan)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Catatan</p>
                            <p class="text-on-surface italic">{{ $order->catatan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
