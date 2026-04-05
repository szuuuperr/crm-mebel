@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('products') }}">Koleksi</a>
        <span class="text-outline-variant">/</span>
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('products.show', 1) }}">Custom Walnut Dining Table</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Ubah</span>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Ubah Produk</h2>
            <p class="text-on-surface-variant mt-1">Perbarui detail kreasi Anda</p>
        </div>
        <div class="flex gap-3">
            <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('products.show', 1) }}">
                <span class="material-symbols-outlined text-sm">close</span>
                Batal
            </a>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Perubahan
            </button>
        </div>
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
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Produk</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" type="text" value="Custom Walnut Dining Table"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kategori</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option>Meja Makan</option>
                                <option>Kursi</option>
                                <option>Lemari</option>
                                <option>Tempat Tidur</option>
                                <option>Meja Kerja</option>
                                <option>Bufet</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Koleksi</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option>Signature Collection</option>
                                <option>Heritage Series</option>
                                <option>Nordic Line</option>
                                <option>Modern Essentials</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" rows="4">Hand-crafted from premium American Black Walnut with natural live edges. Each piece is unique, featuring the wood's natural grain patterns and organic contours.</textarea>
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
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Material Utama</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option selected>American Black Walnut</option>
                                <option>White Oak</option>
                                <option>Cherry Wood</option>
                                <option>Mahogany</option>
                                <option>Reclaimed Teak</option>
                                <option>Nordic Pine</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Finish</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option selected>Natural Tung Oil</option>
                                <option>Matte Lacquer</option>
                                <option>Satin Varnish</option>
                                <option>Wax Polish</option>
                                <option>Raw / Unfinished</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Panjang (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="96"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Lebar (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="42"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tinggi (cm)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="30"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Berat (kg)</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="185"/>
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
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Harga Dasar (Rp)</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="4200"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jumlah Stok</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number" value="2"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">SKU</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" value="WDT-8821"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4 space-y-6">
            <!-- Image Upload -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h4 class="text-sm font-bold text-primary mb-4">Foto Produk</h4>
                <div class="border-2 border-dashed border-outline-variant/40 rounded-xl p-8 text-center hover:border-primary/50 hover:bg-primary/5 transition-all cursor-pointer group">
                    <span class="material-symbols-outlined text-4xl text-outline group-hover:text-primary transition-colors mb-2 block">cloud_upload</span>
                    <p class="text-sm font-bold text-on-surface-variant">Tarik & letakkan gambar</p>
                    <p class="text-xs text-outline mt-1">atau klik untuk jelajahi</p>
                </div>
                <div class="grid grid-cols-3 gap-3 mt-4">
                    <div class="relative h-20 rounded-lg overflow-hidden group">
                        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A"/>
                        <button class="absolute top-1 right-1 w-6 h-6 bg-error text-on-error rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-xs">close</span>
                        </button>
                    </div>
                    <div class="relative h-20 rounded-lg overflow-hidden group">
                        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBG7QyHUGiNALUJffjCdcNoPJMxyXq3icljT_Lrd6O0YiJixiBBMeYEh-X3DgfyZaDceQy1bXRpqksgvLv5KeG18YSg7hcs-HaigiLGo13TKHQHIr-7aof1N2lv5RcQSQ17EEaUIdLgwr2qlFSNUIY-DxjQnK17ASwCrzrW3XTSWLuEvkRmiSqq5xmYis8r-T-t1DRyWrwbaiNiBAVTAPH8HaiMFHNfLhKNOgJ-z9laZ2h3a0It5W5dxKGKv8SL8zBGmtAq3ecEnucC"/>
                        <button class="absolute top-1 right-1 w-6 h-6 bg-error text-on-error rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-xs">close</span>
                        </button>
                    </div>
                    <div class="h-20 rounded-lg border-2 border-dashed border-outline-variant/30 flex items-center justify-center cursor-pointer hover:border-primary/50 transition-colors">
                        <span class="material-symbols-outlined text-outline">add</span>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h4 class="text-sm font-bold text-primary mb-4">Status & Visibilitas</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Status</label>
                        <select class="w-full px-5 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm">
                            <option selected>Aktif — Terlihat di Showroom</option>
                            <option>Draft — Tersembunyi</option>
                            <option>Diarsipkan</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <span class="text-sm font-medium text-on-surface">Produk Unggulan</span>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input checked class="sr-only peer" type="checkbox"/>
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

            <!-- Danger Zone -->
            <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                <p class="text-xs text-on-surface-variant mb-4">Hapus produk ini secara permanen dari katalog.</p>
                <button class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">delete_forever</span>
                    Hapus Produk
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
