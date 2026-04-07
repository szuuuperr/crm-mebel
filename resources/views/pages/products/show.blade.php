@extends('layouts.app')

@section('title', $product->nama_produk . ' - Detail Produk')

@section('content')
    <div class="pt-28 px-10 pb-20">
        <!-- Breadcrumb -->
         
        <nav class="flex items-center gap-2 text-sm mb-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-medium"
                href="{{ route('products') }}">
                Produk
            </a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary font-bold">{{ $product->nama_produk }}</span>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div
                class="mb-6 p-4 bg-secondary-container text-on-secondary-container rounded-lg font-medium background-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product Detail Grid -->
        <div class="grid grid-cols-12 gap-10">
            <!-- Image Gallery -->
            <div class="col-span-7">
                <div
                    class="rounded-xl overflow-hidden h-[500px] mb-4 bg-surface-container-high group flex items-center justify-center">
                    @if($product->cover_url)
                        <img alt="{{ $product->nama_produk }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            src="{{ $product->cover_url }}" />
                    @else
                        <span class="material-symbols-outlined text-8xl text-outline/30">chair</span>
                    @endif
                </div>
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $i => $img)
                            <div
                                class="rounded-lg overflow-hidden h-24 bg-surface-container-high cursor-pointer {{ $i === 0 ? 'ring-2 ring-primary' : 'hover:ring-2 hover:ring-outline-variant' }} transition-all">
                                <img alt="{{ $img->alt_text ?? $product->nama_produk }}" class="w-full h-full object-cover"
                                    src="{{ $img->path }}" />
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="col-span-5 space-y-8">
                <!-- Header -->
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full tracking-wider">{{ $product->kategori->nama ?? '-' }}</span>
                        <span
                            class="px-3 py-1 {{ $product->stok > 0 ? 'bg-secondary-container text-on-secondary-container' : 'bg-error/10 text-error' }} text-[10px] font-black uppercase rounded-full tracking-wider">{{ $product->stok > 0 ? 'Tersedia' : 'Habis' }}</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-primary tracking-tight font-headline mb-2">
                        {{ $product->nama_produk }}</h1>
                    <p class="text-on-surface-variant leading-relaxed">{{ $product->deskripsi }}</p>
                </div>

                <!-- Price -->
                <div class="bg-surface-container-low rounded-xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">Harga</p>
                            <p class="text-4xl font-black text-primary font-headline">{{ $product->harga_format }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">SKU</p>
                            <p class="text-lg font-bold text-on-surface">{{ $product->sku }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Specs -->
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $specs = [
                            ['icon' => 'forest', 'label' => 'Jenis Kayu', 'value' => $product->jenisKayu->nama ?? '-'],
                            ['icon' => 'scale', 'label' => 'Berat', 'value' => $product->berat ? $product->berat . ' kg' : '-'],
                            ['icon' => 'inventory_2', 'label' => 'Stok', 'value' => $product->stok . ' Unit'],
                            ['icon' => 'category', 'label' => 'Kategori', 'value' => $product->kategori->nama ?? '-'],
                        ];
                    @endphp
                    @foreach($specs as $spec)
                        <div class="bg-surface-container-lowest rounded-lg p-4 border border-outline-variant/10">
                            <span class="material-symbols-outlined text-primary text-sm mb-2 block">{{ $spec['icon'] }}</span>
                            <p class="text-[10px] font-bold text-outline uppercase tracking-widest">{{ $spec['label'] }}</p>
                            <p class="text-sm font-bold text-on-surface mt-1">{{ $spec['value'] }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Material Swatch -->
                <div>
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-3">Jenis Kayu</h4>
                    <div class="flex gap-3">
                        <div class="w-12 h-12 rounded-lg ring-2 ring-primary ring-offset-2"
                            style="background-color: {{ $product->jenisKayu->kode_warna ?? '#8B6914' }}"
                            title="{{ $product->jenisKayu->nama ?? '-' }}"></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-4">
                    <a class="flex-1 bg-primary text-on-primary py-4 rounded-full font-bold text-center flex items-center justify-center gap-2 shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all"
                        href="{{ route('products.edit', $product->id) }}">
                        <span class="material-symbols-outlined text-xl">edit</span>
                        Ubah Produk
                    </a>
                    <button type="button"
                        onclick="if(confirm('Anda yakin ingin menghapus produk ini?')) document.getElementById('deleteForm').submit()"
                        class="w-14 h-14 flex items-center justify-center border-2 border-error/30 rounded-full text-error hover:bg-error hover:text-on-error transition-all">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
                <form id="deleteForm" action="{{ route('products.destroy', $product->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

        <!-- Detail Tabs Section -->
        <div class="mt-16">
            <div class="flex gap-2 border-b border-outline-variant/20 mb-8">
                <button class="px-6 py-3 text-primary font-bold border-b-2 border-primary text-sm">Spesifikasi</button>
                <button
                    class="px-6 py-3 text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Detail
                    Kayu</button>
                <button
                    class="px-6 py-3 text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Riwayat
                    Pesanan</button>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-8 bg-surface-container-lowest rounded-xl p-8">
                    <h3 class="text-xl font-bold text-primary mb-6">Spesifikasi Teknis</h3>
                    <div class="divide-y divide-outline-variant/20">
                        @php
                            $details = [
                                ['label' => 'Nama Produk', 'value' => $product->nama_produk],
                                ['label' => 'Kategori', 'value' => $product->kategori->nama ?? '-'],
                                ['label' => 'Material Utama', 'value' => $product->jenisKayu->nama ?? '-'],
                                ['label' => 'Berat', 'value' => $product->berat ? $product->berat . ' kg' : '-'],
                                ['label' => 'SKU', 'value' => $product->sku],
                                ['label' => 'Stok', 'value' => $product->stok . ' unit'],
                                ['label' => 'Status', 'value' => ucfirst($product->status)],
                            ];
                        @endphp
                        @foreach($details as $detail)
                            <div class="flex justify-between py-4">
                                <span class="text-sm font-medium text-on-surface-variant">{{ $detail['label'] }}</span>
                                <span class="text-sm font-bold text-on-surface">{{ $detail['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-span-4 space-y-6">
                    <!-- Production Status -->
                    <div class="bg-primary text-on-primary rounded-xl p-6 relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 opacity-10">
                            <span class="material-symbols-outlined text-[100px]">handyman</span>
                        </div>
                        <div class="relative z-10">
                            <p class="text-xs font-bold uppercase tracking-widest text-on-primary/60 mb-4">Status Produk</p>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-on-primary/70">Stok Tersedia</span>
                                    <span class="text-sm font-bold">{{ $product->stok }} Unit</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-on-primary/70">Status</span>
                                    <span class="text-sm font-bold">{{ ucfirst($product->status) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-on-primary/70">Visibilitas</span>
                                    <span class="text-sm font-bold">{{ ucfirst($product->visibilitas) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info -->
                    <div class="bg-surface-container-low rounded-xl p-6">
                        <h4 class="text-sm font-bold text-primary mb-4">Info Cepat</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-on-surface-variant">Dibuat</span>
                                <span
                                    class="font-bold text-on-surface">{{ $product->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-on-surface-variant">Diperbarui</span>
                                <span class="font-bold text-on-surface">{{ $product->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection