@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
    <!-- Content Area -->
    <div class="pt-28 pb-12 px-10">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-secondary-container text-on-secondary-container rounded-lg font-medium">
            {{ session('success') }}
        </div>
        @endif
        <!-- Page Header Section -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black font-headline text-primary tracking-tight mb-2">Koleksi Produk Mebel</h2>
                <p class="text-on-surface-variant max-w-md">Kelola kreasi kerajinan Anda, lacak stok material, dan perbarui
                    inventaris showroom digital Anda.</p>
            </div>
            <a class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 shadow-lg shadow-primary/10 hover:scale-105 transition-transform"
                href="{{ route('products.create') }}">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Furniture Baru
            </a>
        </div>

        <!-- Filters Bar -->
        <form action="{{ route('products') }}" method="GET" class="flex items-start gap-4 mb-10 overflow-x-auto h-80% pt-4">
            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('products') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ !request()->hasAny(['kategori', 'jenis_kayu', 'stok_status', 'search', 'sort']) ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                    Semua Koleksi
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products', array_merge(request()->except('page'), ['kategori' => $cat->id])) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('kategori') == $cat->id ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                        {{ $cat->nama }}
                    </a>
                @endforeach
            </div>
            <div class="ml-auto flex items-center gap-3">
                <select name="stok_status" onchange="this.form.submit()" class="px-4 py-2.5 w-36 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                    <option value="">Semua Stok</option>
                    <option value="aman" {{ request('stok_status') == 'aman' ? 'selected' : '' }}>Stok Aman</option>
                    <option value="menipis" {{ request('stok_status') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                    <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
                <select name="sort" onchange="this.form.submit()" class="px-4 py-2.5 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="harga_terendah" {{ request('sort') == 'harga_terendah' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="harga_tertinggi" {{ request('sort') == 'harga_tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="stok_terendah" {{ request('sort') == 'stok_terendah' ? 'selected' : '' }}>Stok Terendah</option>
                    <option value="nama_az" {{ request('sort') == 'nama_az' ? 'selected' : '' }}>Nama A-Z</option>
                </select>
                <div class="flex items-center gap-1">
                    <button type="button" id="btnGridView" onclick="setView('grid')" class="flex items-center justify-center p-2 w-10 h-10 rounded-lg bg-primary text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">grid_view</span>
                    </button>
                    <button type="button" id="btnListView" onclick="setView('list')" class="flex items-center justify-center p-2 w-10 h-10 rounded-lg text-outline hover:bg-surface-container-low transition-colors">
                        <span class="material-symbols-outlined text-[20px]">list</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'stok_status', 'sort']))
        <div class="flex items-center gap-2 mb-6 flex-wrap">
            <span class="text-xs font-bold text-outline uppercase">Filter Aktif:</span>
            @if(request('search'))
            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                Cari: "{{ request('search') }}"
                <a href="{{ route('products', request()->except(['search', 'page'])) }}" class="hover:text-error">&times;</a>
            </span>
            @endif
            @if(request('stok_status'))
            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                Stok: {{ ucfirst(request('stok_status')) }}
                <a href="{{ route('products', request()->except(['stok_status', 'page'])) }}" class="hover:text-error">&times;</a>
            </span>
            @endif
            @if(request('sort') && request('sort') !== 'terbaru')
            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                Urutkan: {{ str_replace('_', ' ', ucfirst(request('sort'))) }}
                <a href="{{ route('products', request()->except(['sort', 'page'])) }}" class="hover:text-error">&times;</a>
            </span>
            @endif
            @if(request()->hasAny(['search', 'stok_status', 'sort']))
            <a href="{{ route('products') }}" class="px-3 py-1 text-xs font-bold text-error hover:underline">Reset Semua</a>
            @endif
        </div>
        @endif

        <!-- Product Grid -->
        <div id="productContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="product-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-outline-variant/10">
                    <a href="{{ route('products.show', $product->id) }}" class="block">
                        <div class="relative h-72 overflow-hidden bg-surface-container-high flex items-center justify-center">
                            @if($product->cover_url)
                                <img alt="{{ $product->nama_produk }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    src="{{ $product->cover_url }}" loading="lazy" />
                            @else
                                <span class="material-symbols-outlined text-6xl text-outline/30">chair</span>
                            @endif
                            <div class="absolute bottom-4 right-4 glass-overlay px-4 py-2 rounded-lg flex items-center gap-2">
                                @if($product->stok > 5)
                                    <span class="text-xs font-bold text-green-400">Stok:</span>
                                    <span class="text-xs font-black text-green-400">{{ $product->stok }} Unit</span>
                                @elseif($product->stok > 0)
                                    <span class="text-xs font-bold text-error">Stok Menipis:</span>
                                    <span class="text-xs font-black text-error">{{ $product->stok }} Unit</span>
                                @else
                                    <span class="text-xs font-bold text-on-tertiary-container">Habis</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold font-headline text-on-surface group-hover:text-primary transition-colors">
                                    {{ $product->nama_produk }}
                                </h3>
                                <p class="text-sm text-on-surface-variant">{{ $product->kategori->nama ?? '-' }}</p>
                            </div>
                            <span class="text-2xl font-black text-primary font-headline">{{ $product->harga_format }}</span>
                        </div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex items-center gap-1 bg-surface-container-low px-2 py-1 rounded-md">
                                <div class="w-3 h-3 rounded-full"
                                    style="background-color: {{ $product->jenisKayu->kode_warna ?? '#8B6914' }}"></div>
                                <span class="text-[11px] font-bold text-on-surface-variant">{{ $product->jenisKayu->nama ?? '-' }}</span>
                            </div>
                            @if($product->berat)
                                <div class="flex items-center gap-1 bg-surface-container-low px-2 py-1 rounded-md">
                                    <span class="material-symbols-outlined text-[14px]">scale</span>
                                    <span class="text-[11px] font-bold text-on-surface-variant">{{ $product->berat }} kg</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('products.show', $product->id) }}"
                                class="flex-1 bg-primary text-on-primary py-3 rounded-full text-sm font-bold text-center hover:bg-primary-container transition-colors">Lihat
                                Detail</a>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="w-12 h-12 flex items-center justify-center border-2 border-outline-variant/30 rounded-full text-outline hover:border-primary hover:text-primary transition-all">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-outline/30 mb-4">inventory_2</span>
                    <p class="text-lg font-bold text-on-surface-variant">Tidak ada produk yang ditemukan.</p>
                    @if(request()->hasAny(['kategori', 'jenis_kayu', 'stok_status', 'search']))
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-primary font-bold hover:underline">Reset Filter</a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex items-center justify-between">
            <p class="text-sm text-on-surface-variant">Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} Produk</p>
            @if($products->hasPages())
            <div>{{ $products->links() }}</div>
            @endif
        </div>

        <!-- Inventory Insights Section -->
        <div class="mt-16 grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-3 bg-surface-container-low rounded-xl p-8 flex flex-col md:flex-row gap-8 items-center">
                <div class="flex-1">
                    <h4 class="text-xl font-bold font-headline text-primary mb-2">Laporan Kesehatan Material</h4>
                    <p class="text-sm text-on-surface-variant mb-6">Tingkat kayu mentah saat ini untuk siklus produksi aktif.</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse($woodTypes->take(4) as $wood)
                            @php
                                $totalProducts = $wood->products_count;
                                $pct = $totalProducts > 0 ? min(round(($totalProducts / max($woodTypes->max('products_count'), 1)) * 100), 100) : 0;
                                $color = $totalProducts <= 3 ? 'bg-error' : 'bg-primary';
                            @endphp
                            <div class="space-y-2">
                                <div class="flex justify-between text-[10px] font-black text-primary uppercase">
                                    <span>{{ $wood->nama }}</span><span>{{ $pct }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-outline-variant/30 rounded-full overflow-hidden">
                                    <div class="h-full {{ $color }}" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-on-surface-variant col-span-4">Belum ada data jenis kayu.</p>
                        @endforelse
                    </div>
                </div>
                <div class="w-full md:w-px h-px md:h-24 bg-outline-variant/30"></div>
                <div class="text-center px-4">
                    <p class="text-3xl font-black text-primary font-headline">{{ $totalSku }}</p>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mt-1">Total SKU's</p>
                </div>
            </div>
            <div class="bg-surface-container-high rounded-xl p-8 flex flex-col justify-center text-center group cursor-pointer hover:bg-primary hover:text-on-primary transition-all duration-300">
                <span class="material-symbols-outlined text-4xl mb-3 text-primary group-hover:text-on-primary transition-colors">analytics</span>
                <h4 class="font-bold font-headline mb-1">Peringatan Stok</h4>
                <p class="text-xs text-on-surface-variant group-hover:text-on-primary/80 transition-colors">{{ $lowStock }} Items stok menipis, {{ $outOfStock }} habis</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function setView(mode) {
        const container = document.getElementById('productContainer');
        const btnGrid = document.getElementById('btnGridView');
        const btnList = document.getElementById('btnListView');
        const cards = document.querySelectorAll('.product-card');

        if (mode === 'grid') {
            container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8';
            btnGrid.className = 'flex items-center justify-center p-2 w-10 h-10 rounded-lg bg-primary text-on-primary transition-colors';
            btnList.className = 'flex items-center justify-center p-2 w-10 h-10 rounded-lg text-outline hover:bg-surface-container-low transition-colors';
            cards.forEach(card => {
                card.className = 'product-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-outline-variant/10';
                const imgDiv = card.querySelector('.relative');
                if (imgDiv) {
                    imgDiv.className = 'relative h-72 overflow-hidden bg-surface-container-high flex items-center justify-center';
                    imgDiv.classList.remove('w-72', 'flex-shrink-0');
                }
                const contentDiv = card.querySelector('.p-6');
                if (contentDiv) {
                    contentDiv.className = 'p-8';
                }
                const linkBlock = card.querySelector('a.block');
                if (linkBlock) {
                    linkBlock.className = 'block';
                }
            });
        } else {
            container.className = 'flex flex-col gap-6';
            btnList.className = 'flex items-center justify-center p-2 w-10 h-10 rounded-lg bg-primary text-on-primary transition-colors';
            btnGrid.className = 'flex items-center justify-center p-2 w-10 h-10 rounded-lg text-outline hover:bg-surface-container-low transition-colors';
            cards.forEach(card => {
                card.className = 'product-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/10 flex flex-row';
                const imgDiv = card.querySelector('.relative');
                if (imgDiv) {
                    imgDiv.className = 'relative h-48 w-72 overflow-hidden bg-surface-container-high flex items-center justify-center flex-shrink-0';
                }
                const contentDiv = card.querySelector('.p-8');
                if (contentDiv) {
                    contentDiv.className = 'p-6 flex-1 flex flex-col justify-between';
                }
                const linkBlock = card.querySelector('a.block');
                if (linkBlock) {
                    linkBlock.className = 'block flex-shrink-0';
                }
            });
        }

        localStorage.setItem('productView', mode);
    }

    // Restore saved view
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('productView');
        if (savedView === 'list') {
            setView('list');
        }
    });
</script>
@endpush
