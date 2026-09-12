@extends('layouts.pelanggan')

@section('title', 'Katalog Produk')
@section('page-title', 'Katalog Produk')
@section('page-subtitle', 'Jelajahi koleksi produk mebel kami')

@section('content')
    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('pelanggan.katalog.index') }}" class="mb-8">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-xl">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant/30 rounded-xl text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all" />
                </div>
            </div>
            <select name="kategori" class="bg-white border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }} ({{ $cat->products_count }})</option>
                @endforeach
            </select>
            <select name="jenis_kayu" class="bg-white border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Jenis Kayu</option>
                @foreach($woodTypes as $wt)
                    <option value="{{ $wt->id }}" {{ request('jenis_kayu') == $wt->id ? 'selected' : '' }}>{{ $wt->nama }} ({{ $wt->products_count }})</option>
                @endforeach
            </select>
            <select name="sort" class="bg-white border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/30">
                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="harga_terendah" {{ request('sort') == 'harga_terendah' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="harga_tertinggi" {{ request('sort') == 'harga_tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="nama_az" {{ request('sort') == 'nama_az' ? 'selected' : '' }}>Nama A-Z</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold text-sm rounded-xl hover:bg-primary-container transition-colors">
                Filter
            </button>
        </div>
    </form>

    {{-- Product Grid --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($products as $product)
                <a href="{{ route('pelanggan.katalog.show', $product->id) }}"
                   class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    {{-- Image --}}
                    <div class="aspect-[4/3] bg-surface-container relative overflow-hidden">
                        @if($product->cover_url)
                            <img src="{{ $product->cover_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-5xl text-outline/30">chair</span>
                            </div>
                        @endif
                        @if($product->is_unggulan)
                            <span class="absolute top-3 left-3 px-3 py-1 bg-amber-500 text-white text-xs font-bold rounded-full">⭐ Unggulan</span>
                        @endif
                    </div>
                    {{-- Info --}}
                    <div class="p-5">
                        <p class="text-xs text-on-surface-variant mb-1">{{ $product->kategori->nama ?? '-' }} • {{ $product->jenisKayu->nama ?? '-' }}</p>
                        <h3 class="text-base font-bold text-on-surface font-headline mb-2 line-clamp-1">{{ $product->nama_produk }}</h3>
                        <p class="text-lg font-extrabold text-primary font-headline">{{ $product->harga_format }}</p>
                        @if($product->stok > 0)
                            <span class="mt-2 inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">Tersedia</span>
                        @else
                            <span class="mt-2 inline-block px-3 py-1 bg-red-50 text-red-700 text-xs font-bold rounded-full">Habis</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-outline/30 mb-4">chair</span>
            <p class="text-on-surface-variant font-medium">Tidak ada produk ditemukan.</p>
        </div>
    @endif
@endsection
