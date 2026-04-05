@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('products') }}">Koleksi</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Furniture Baru</span>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tambah Furniture Baru</h2>
            <p class="text-on-surface-variant mt-1">Perkenalkan karya baru ke koleksi Anda</p>
        </div>
        <div class="flex gap-3">
            <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('products') }}">
                <span class="material-symbols-outlined text-sm">close</span>
                Buang
            </a>
            <button class="px-6 py-3 border-2 border-primary/30 text-primary font-bold rounded-full hover:bg-primary/5 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">draft</span>
                Simpan Draft
            </button>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">publish</span>
                Publikasikan
            </button>
        </div>
    </div>

    <!-- Step Progress -->
    <div class="flex items-center gap-4 mb-12">
        @php
            $steps = [
                ['num' => 1, 'label' => 'Info Dasar', 'active' => true],
                ['num' => 2, 'label' => 'Material & Spek', 'active' => false],
                ['num' => 3, 'label' => 'Harga & Stok', 'active' => false],
                ['num' => 4, 'label' => 'Foto', 'active' => false],
            ];
        @endphp
        @foreach($steps as $i => $step)
        <div class="flex items-center gap-3 {{ $i < count($steps) - 1 ? 'flex-1' : '' }}">
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $step['active'] ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-outline' }}">
                {{ $step['num'] }}
            </div>
            <span class="text-sm font-bold {{ $step['active'] ? 'text-primary' : 'text-outline' }} whitespace-nowrap">{{ $step['label'] }}</span>
            @if($i < count($steps) - 1)
            <div class="flex-1 h-px bg-outline-variant/30 mx-2"></div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-12 gap-10">
        <!-- Form Section -->
        <div class="col-span-8 space-y-8">
            <!-- Basic Information -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">info</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Informasi Dasar</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Produk *</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Meja Makan Heritage Oak" type="text"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kategori *</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih kategori...</option>
                                <option>Meja Makan</option>
                                <option>Kursi</option>
                                <option>Lemari</option>
                                <option>Tempat Tidur</option>
                                <option>Meja Kerja</option>
                                <option>Bufet</option>
                                <option>Sofa</option>
                                <option>Rak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Koleksi</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih koleksi...</option>
                                <option>Signature Collection</option>
                                <option>Heritage Series</option>
                                <option>Nordic Line</option>
                                <option>Modern Essentials</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Jelaskan kreasi Anda — asal kayu, inspirasi desain, detail keahlian..." rows="4"></textarea>
                    </div>
                </div>
            </div>

            <!-- Materials & Dimensions -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">carpenter</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Material & Dimensi</h3>
                </div>
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Material Utama *</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih material...</option>
                                <option>American Black Walnut</option>
                                <option>White Oak</option>
                                <option>Cherry Wood</option>
                                <option>Mahogany</option>
                                <option>Reclaimed Teak</option>
                                <option>Nordic Pine</option>
                                <option>Maple</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jenis Finishing</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih finishing...</option>
                                <option>Natural Tung Oil</option>
                                <option>Matte Lacquer</option>
                                <option>Satin Varnish</option>
                                <option>Wax Polish</option>
                                <option>Raw / Unfinished</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Panjang (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0" type="number"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Lebar (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0" type="number"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tinggi (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0" type="number"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Berat (kg)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0" type="number"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">payments</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Harga & Stok</h3>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Harga Dasar (Rp) *</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0.00" type="number"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jumlah Stok</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0" type="number"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">SKU</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="Otomatis" type="text"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Image Upload & Options -->
        <div class="col-span-4 space-y-6">
            <!-- Photo Upload -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h4 class="text-sm font-bold text-primary mb-4">Foto Produk</h4>
                <div class="border-2 border-dashed border-outline-variant/40 rounded-xl p-10 text-center hover:border-primary/50 hover:bg-primary/5 transition-all cursor-pointer group">
                    <span class="material-symbols-outlined text-5xl text-outline group-hover:text-primary transition-colors mb-3 block">add_photo_alternate</span>
                    <p class="text-sm font-bold text-on-surface-variant">Tarik foto ke sini</p>
                    <p class="text-xs text-outline mt-1">PNG, JPG hingga 10MB per file</p>
                    <p class="text-[10px] text-outline mt-2">Rekomendasi: 1200 × 800px</p>
                </div>
            </div>

            <!-- Status & Options -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h4 class="text-sm font-bold text-primary mb-4">Opsi Publikasi</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Visibilitas</label>
                        <select class="w-full px-5 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm">
                            <option>Aktif — Terlihat di Showroom</option>
                            <option selected>Draft — Tersembunyi</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm font-medium text-on-surface">Produk Unggulan</span>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input class="sr-only peer" type="checkbox"/>
                            <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm font-medium text-on-surface">Terima Pesanan Kustom</span>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox"/>
                            <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary text-sm">lightbulb</span>
                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Tips Pro</span>
                </div>
                <p class="text-xs text-on-surface-variant leading-relaxed">Foto berkualitas tinggi dengan pencahayaan alami menampilkan serat kayu dengan terbaik. Sertakan minimal 3 sudut: depan, detail close-up, dan konteks gaya hidup.</p>
            </div>
        </div>
    </div>
</div>
@endsection
