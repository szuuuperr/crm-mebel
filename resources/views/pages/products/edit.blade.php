@extends('layouts.app')

@section('title', 'Ubah Produk — ' . $product->nama_produk)

@section('content')
    <div class="pt-28 px-10 pb-20">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm mb-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-medium"
                href="{{ route('products') }}">Produk</a>
            <span class="text-outline-variant">/</span>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-medium"
                href="{{ route('products.show', $product->id) }}">{{ $product->nama_produk }}</a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary font-bold">Ubah Produk</span>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div
                class="mb-6 p-4 bg-secondary-container text-on-secondary-container rounded-lg font-medium background-green-400">
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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Page Header -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Ubah Produk</h2>
                    <p class="text-on-surface-variant mt-1">Perbarui detail kreasi Anda</p>
                </div>
                <div class="flex gap-3">
                    <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2"
                        href="{{ route('products.show', $product->id) }}">
                        <span class="material-symbols-outlined text-sm">close</span>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
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
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama
                                    Produk</label>
                                <input name="nama_produk"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50"
                                    type="text" value="{{ old('nama_produk', $product->nama_produk) }}" required />
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kategori</label>
                                    <select name="kategori_id"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('kategori_id', $product->kategori_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Koleksi</label>
                                    <select name="koleksi"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                        <option>Signature Collection</option>
                                        <option>Heritage Series</option>
                                        <option>Nordic Line</option>
                                        <option>Modern Essentials</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none"
                                    rows="4">{{ old('deskripsi', $product->deskripsi) }}</textarea>
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
                                        Utama</label>
                                    <select name="jenis_kayu_id"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        required>
                                        @foreach($woodTypes as $wt)
                                            <option value="{{ $wt->id }}" {{ old('jenis_kayu_id', $product->jenis_kayu_id) == $wt->id ? 'selected' : '' }}>{{ $wt->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Finish</label>
                                    <select name="finishing"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                        @php $currentFinishing = old('finishing', $product->finishing); @endphp
                                        <option value="">Pilih finishing...</option>
                                        <option {{ $currentFinishing == 'Natural Tung Oil' ? 'selected' : '' }}>Natural Tung
                                            Oil</option>
                                        <option {{ $currentFinishing == 'Matte Lacquer' ? 'selected' : '' }}>Matte Lacquer
                                        </option>
                                        <option {{ $currentFinishing == 'Satin Varnish' ? 'selected' : '' }}>Satin Varnish
                                        </option>
                                        <option {{ $currentFinishing == 'Wax Polish' ? 'selected' : '' }}>Wax Polish</option>
                                        <option {{ $currentFinishing == 'Raw / Unfinished' ? 'selected' : '' }}>Raw /
                                            Unfinished</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Panjang
                                        (cm)</label>
                                    <input name="panjang"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        type="number" step="0.01" value="{{ old('panjang', $product->panjang) }}" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Lebar
                                        (cm)</label>
                                    <input name="lebar"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        type="number" step="0.01" value="{{ old('lebar', $product->lebar) }}" />
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tinggi
                                        (cm)</label>
                                    <input name="tinggi"
                                        class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                        type="number" step="0.01" value="{{ old('tinggi', $product->tinggi) }}" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Berat
                                    (kg)</label>
                                <input name="berat"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    type="number" step="0.01" value="{{ old('berat', $product->berat) }}" />
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
                                    Dasar (Rp)</label>
                                <input name="harga"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    type="number" value="{{ old('harga', $product->harga) }}" required />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jumlah
                                    Stok</label>
                                <input name="stok"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    type="number" value="{{ old('stok', $product->stok) }}" />
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">SKU</label>
                                <input name="sku"
                                    class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"
                                    type="text" value="{{ old('sku', $product->sku) }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-span-4 space-y-6">
                    <!-- Image Upload -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Foto Produk</h4>
                        <label
                            class="border-2 border-dashed border-outline-variant/40 rounded-xl p-8 text-center hover:border-primary/50 hover:bg-primary/5 transition-all cursor-pointer group block">
                            <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple
                                class="hidden" id="imageInput" />
                            <span
                                class="material-symbols-outlined text-4xl text-outline group-hover:text-primary transition-colors mb-2 block">cloud_upload</span>
                            <p class="text-sm font-bold text-on-surface-variant">Tambahkan foto baru</p>
                            <p class="text-xs text-outline mt-1">klik untuk jelajahi</p>
                        </label>

                        <!-- New image preview -->
                        <div id="imagePreview" class="grid grid-cols-3 gap-3 mt-4 hidden"></div>

                        <!-- Existing images -->
                        @if($product->images->count() > 0)
                            <p class="text-xs font-bold text-outline uppercase tracking-widest mt-6 mb-3">Foto Saat Ini</p>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach($product->images as $img)
                                    <div class="relative h-20 rounded-lg overflow-hidden group">
                                        <img class="w-full h-full object-cover" src="{{ $img->path }}" alt="{{ $img->alt_text }}" />
                                        @if($img->is_cover)
                                            <span
                                                class="absolute top-1 left-1 px-1.5 py-0.5 bg-primary text-on-primary text-[8px] font-bold rounded uppercase">Cover</span>
                                        @endif
                                        {{-- Delete image button (separate form) --}}
                                        <button type="button" onclick="deleteImage({{ $img->id }})"
                                            class="absolute top-1 right-1 w-6 h-6 bg-error text-on-error rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="material-symbols-outlined text-xs">close</span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Status & Visibilitas</h4>
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Visibilitas</label>
                                <select name="visibilitas"
                                    class="w-full px-5 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm">
                                    <option value="aktif" {{ old('visibilitas', $product->visibilitas) == 'aktif' ? 'selected' : '' }}>Aktif — Terlihat di Showroom</option>
                                    <option value="draft" {{ old('visibilitas', $product->visibilitas) == 'draft' ? 'selected' : '' }}>Draft — Tersembunyi</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="text-sm font-medium text-on-surface">Produk Unggulan</span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input name="is_unggulan" class="sr-only peer" type="checkbox" {{ old('is_unggulan', $product->is_unggulan) ? 'checked' : '' }} />
                                    <div
                                        class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="text-sm font-medium text-on-surface">Terima Pesanan Kustom</span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input name="terima_kustom" class="sr-only peer" type="checkbox" {{ old('terima_kustom', $product->terima_kustom) ? 'checked' : '' }} />
                                    <div
                                        class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                        <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                        <p class="text-xs text-on-surface-variant mb-4">Hapus produk ini secara permanen dari katalog.</p>
                        <button type="button" onclick="deleteProduct()"
                            class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">delete_forever</span>
                            Hapus Produk
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Hidden forms for delete actions --}}
        <form id="deleteProductForm" action="{{ route('products.destroy', $product->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        @foreach($product->images as $img)
            <form id="deleteImageForm-{{ $img->id }}" action="{{ route('products.image.destroy', $img->id) }}" method="POST"
                class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>

    @push('scripts')
        <script>
            // Image preview for new uploads
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

            // Delete product confirmation
            function deleteProduct() {
                if (confirm('Anda yakin ingin menghapus produk ini? Tindakan ini tidak bisa dibatalkan.')) {
                    document.getElementById('deleteProductForm').submit();
                }
            }

            // Delete single image confirmation
            function deleteImage(imageId) {
                if (confirm('Hapus gambar ini?')) {
                    document.getElementById('deleteImageForm-' + imageId).submit();
                }
            }
        </script>
    @endpush
@endsection