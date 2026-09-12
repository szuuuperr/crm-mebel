@extends('layouts.pelanggan')

@section('title', $product->nama_produk)
@section('page-title', $product->nama_produk)
@section('page-subtitle', 'Detail Produk')

@section('content')
    {{-- Back --}}
    <a href="{{ route('pelanggan.katalog.index') }}" class="inline-flex items-center gap-2 text-sm text-on-surface-variant hover:text-primary transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Kembali ke Katalog
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Images --}}
        <div class="space-y-4">
            @if($product->images->count() > 0)
                <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden">
                    <img id="mainImage" src="{{ $product->images->first()->path }}" alt="{{ $product->nama_produk }}"
                        class="w-full h-full object-cover" />
                </div>
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($product->images as $image)
                            <button onclick="document.getElementById('mainImage').src='{{ $image->path }}'"
                                class="aspect-square rounded-xl overflow-hidden border-2 border-transparent hover:border-primary transition-colors focus:border-primary">
                                <img src="{{ $image->path }}" alt="" class="w-full h-full object-cover" />
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="aspect-square bg-surface-container rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-8xl text-outline/20">chair</span>
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="space-y-6">
            <div>
                <p class="text-sm text-on-surface-variant mb-2">{{ $product->kategori->nama ?? '-' }} • {{ $product->jenisKayu->nama ?? '-' }}</p>
                <h1 class="text-3xl font-extrabold text-on-surface font-headline mb-3">{{ $product->nama_produk }}</h1>
                <p class="text-3xl font-extrabold text-primary font-headline">{{ $product->harga_format }}</p>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-3">
                @if($product->stok > 0)
                    <span class="px-4 py-2 bg-emerald-50 text-emerald-700 text-sm font-bold rounded-full">✓ Tersedia ({{ $product->stok }} unit)</span>
                @else
                    <span class="px-4 py-2 bg-red-50 text-red-700 text-sm font-bold rounded-full">Stok Habis</span>
                @endif
                @if($product->is_unggulan)
                    <span class="px-4 py-2 bg-amber-50 text-amber-700 text-sm font-bold rounded-full">⭐ Produk Unggulan</span>
                @endif
                @if($product->terima_kustom)
                    <span class="px-4 py-2 bg-blue-50 text-blue-700 text-sm font-bold rounded-full">🎨 Menerima Kustom</span>
                @endif
            </div>

            {{-- Description --}}
            @if($product->deskripsi)
                <div class="bg-surface-container-low rounded-2xl p-6">
                    <h3 class="text-sm font-bold text-on-surface mb-3 uppercase tracking-wider">Deskripsi</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $product->deskripsi }}</p>
                </div>
            @endif

            {{-- Specifications --}}
            <div class="bg-surface-container-low rounded-2xl p-6">
                <h3 class="text-sm font-bold text-on-surface mb-4 uppercase tracking-wider">Spesifikasi</h3>
                <div class="grid grid-cols-2 gap-4">
                    @if($product->panjang || $product->lebar || $product->tinggi)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-lg">straighten</span>
                            <div>
                                <p class="text-xs text-on-surface-variant">Dimensi (P×L×T)</p>
                                <p class="text-sm font-bold text-on-surface">{{ $product->panjang ?? '-' }} × {{ $product->lebar ?? '-' }} × {{ $product->tinggi ?? '-' }} cm</p>
                            </div>
                        </div>
                    @endif
                    @if($product->berat)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-lg">scale</span>
                            <div>
                                <p class="text-xs text-on-surface-variant">Berat</p>
                                <p class="text-sm font-bold text-on-surface">{{ $product->berat }} kg</p>
                            </div>
                        </div>
                    @endif
                    @if($product->finishing)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-lg">format_paint</span>
                            <div>
                                <p class="text-xs text-on-surface-variant">Finishing</p>
                                <p class="text-sm font-bold text-on-surface">{{ $product->finishing }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-lg">park</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Jenis Kayu</p>
                            <p class="text-sm font-bold text-on-surface">{{ $product->jenisKayu->nama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-lg">category</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Kategori</p>
                            <p class="text-sm font-bold text-on-surface">{{ $product->kategori->nama ?? '-' }}</p>
                        </div>
                    </div>
                    @if($product->sku)
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-lg">qr_code</span>
                            <div>
                                <p class="text-xs text-on-surface-variant">SKU</p>
                                <p class="text-sm font-bold text-on-surface">{{ $product->sku }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <p class="text-xs text-on-surface-variant">
                Untuk pemesanan, silakan hubungi tim kami atau buat pesanan melalui admin.
            </p>
        </div>
    </div>
@endsection
