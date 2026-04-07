@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
    <div class="pt-28 px-10 pb-20">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm mb-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-medium"
                href="{{ route('products') }}">Produk</a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary font-bold">Tambah Produk Baru</span>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-secondary-container text-on-secondary-container rounded-lg font-medium bg-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-lg">
                <p class="font-bold mb-2">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Page Header -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tambah Produk Baru</h2>
                    <p class="text-on-surface-variant mt-1">Perkenalkan karya baru ke koleksi Anda</p>
                </div>
                <div class="flex gap-3">
                    <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2"
                        href="{{ route('products') }}">
                        <span class="material-symbols-outlined text-sm">close</span>
                        Buang
                    </a>
                    <button type="submit" name="visibilitas" value="draft"
                        class="px-6 py-3 border-2 border-primary/30 text-primary font-bold rounded-full hover:bg-primary/5 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">draft</span>
                        Simpan Draft
                    </button>
                    <button type="submit" name="visibilitas" value="aktif"
                        class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">publish</span>
                        Publikasikan
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
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama
                                    Produk *</label>
                                <input name="nama_produk"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50"
                                    placeholder="cth., Meja Makan Heritage Oak" type="text" value="{{ old('nama_produk') }}"
                                    required />
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kategori
                                        *</label>
                                    <select name="kategori_id"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        required>
                                        <option value="">Pilih kategori...</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Koleksi</label>
                                    <select name="koleksi"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                        <option value="">Pilih koleksi...</option>
                                        <option {{ old('koleksi') == 'Signature Collection' ? 'selected' : '' }}>Signature
                                            Collection</option>
                                        <option {{ old('koleksi') == 'Heritage Series' ? 'selected' : '' }}>Heritage Series
                                        </option>
                                        <option {{ old('koleksi') == 'Nordic Line' ? 'selected' : '' }}>Nordic Line</option>
                                        <option {{ old('koleksi') == 'Modern Essentials' ? 'selected' : '' }}>Modern
                                            Essentials</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none"
                                    placeholder="Jelaskan kreasi Anda — asal kayu, inspirasi desain, detail keahlian..."
                                    rows="4">{{ old('deskripsi') }}</textarea>
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
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Material
                                        Utama *</label>
                                    <select name="jenis_kayu_id"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        required>
                                        <option value="">Pilih material...</option>
                                        @foreach($woodTypes as $wt)
                                            <option value="{{ $wt->id }}" {{ old('jenis_kayu_id') == $wt->id ? 'selected' : '' }}>
                                                {{ $wt->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jenis
                                        Finishing</label>
                                    <select name="finishing"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                        <option value="">Pilih finishing...</option>
                                        <option {{ old('finishing') == 'Natural Tung Oil' ? 'selected' : '' }}>Natural Tung
                                            Oil</option>
                                        <option {{ old('finishing') == 'Matte Lacquer' ? 'selected' : '' }}>Matte Lacquer
                                        </option>
                                        <option {{ old('finishing') == 'Satin Varnish' ? 'selected' : '' }}>Satin Varnish
                                        </option>
                                        <option {{ old('finishing') == 'Wax Polish' ? 'selected' : '' }}>Wax Polish</option>
                                        <option {{ old('finishing') == 'Raw / Unfinished' ? 'selected' : '' }}>Raw /
                                            Unfinished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Panjang
                                        (cm)</label>
                                    <input name="panjang"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        placeholder="0" type="number" step="0.01" value="{{ old('panjang') }}" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Lebar
                                        (cm)</label>
                                    <input name="lebar"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        placeholder="0" type="number" step="0.01" value="{{ old('lebar') }}" />
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tinggi
                                        (cm)</label>
                                    <input name="tinggi"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        placeholder="0" type="number" step="0.01" value="{{ old('tinggi') }}" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Berat
                                        (kg)</label>
                                    <input name="berat"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        placeholder="0" type="number" step="0.01" value="{{ old('berat') }}" />
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
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Harga
                                    Dasar (Rp) *</label>
                                <input name="harga"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    placeholder="0" type="number" value="{{ old('harga') }}" required />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jumlah
                                    Stok</label>
                                <input name="stok"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    placeholder="0" type="number" value="{{ old('stok', 0) }}" />
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">SKU</label>
                                <input name="sku"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    placeholder="Otomatis" type="text" value="{{ old('sku') }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Image Upload & Options -->
                <div class="col-span-4 space-y-6">
                    <!-- Photo Upload -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Foto Produk</h4>
                        <label
                            class="border-2 border-dashed border-outline-variant/40 rounded-xl p-10 text-center hover:border-primary/50 hover:bg-primary/5 transition-all cursor-pointer group block">
                            <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple
                                class="hidden" id="imageInput" />
                            <span
                                class="material-symbols-outlined text-5xl text-outline group-hover:text-primary transition-colors mb-3 block">add_photo_alternate</span>
                            <p class="text-sm font-bold text-on-surface-variant">Klik untuk pilih foto</p>
                            <p class="text-xs text-outline mt-1">PNG, JPG, WEBP hingga 10MB per file</p>
                            <p class="text-[10px] text-outline mt-2">Rekomendasi: 1200 × 800px</p>
                        </label>
                        <!-- Preview container -->
                        <div id="imagePreview" class="grid grid-cols-3 gap-3 mt-4 hidden"></div>
                    </div>

                    <!-- Status & Options -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Opsi Publikasi</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3">
                                <span class="text-sm font-medium text-on-surface">Produk Unggulan</span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input name="is_unggulan" class="sr-only peer" type="checkbox" {{ old('is_unggulan') ? 'checked' : '' }} />
                                    <div
                                        class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="text-sm font-medium text-on-surface">Terima Pesanan Kustom</span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input name="terima_kustom" class="sr-only peer" type="checkbox" checked />
                                    <div
                                        class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
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
                        <p class="text-xs text-on-surface-variant leading-relaxed">Foto berkualitas tinggi dengan
                            pencahayaan alami menampilkan serat kayu dengan terbaik. Sertakan minimal 3 sudut: depan, detail
                            close-up, dan konteks gaya hidup.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Image preview before upload
            document.getElementById('imageInput').addEventListener('change', function (e) {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = '';
                preview.classList.remove('hidden');

                Array.from(e.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (ev) {
                        const div = document.createElement('div');
                        div.className = 'h-20 rounded-lg overflow-hidden';
                        div.innerHTML = `<img class="w-full h-full object-cover" src="${ev.target.result}" alt="Preview"/>`;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            });
        </script>
    @endpush
@endsection