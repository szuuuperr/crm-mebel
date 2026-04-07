@extends('layouts.app')

@section('title', 'Tambah Pelanggan Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Tambah Pelanggan</span>
    </nav>

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

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Daftarkan Pelanggan Baru</h2>
                <p class="text-on-surface-variant mt-1">Tambahkan pelanggan baru ke portofolio Anda</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('customers') }}">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">person_add</span>
                    Simpan Pelanggan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-8 space-y-8">
                <!-- Personal Information -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Informasi Pribadi</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Lengkap *</label>
                            <input name="nama" value="{{ old('nama') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Nama lengkap pelanggan" type="text" required/>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Email</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">mail</span>
                                    <input name="email" value="{{ old('email') }}" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="nama@perusahaan.com" type="email"/>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nomor Telepon</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">call</span>
                                    <input name="telepon" value="{{ old('telepon') }}" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="08xx-xxxx-xxxx" type="tel"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat</label>
                            <div class="relative">
                                <span class="absolute left-4 top-4 material-symbols-outlined text-outline text-[20px]">location_on</span>
                                <textarea name="alamat" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Alamat lengkap..." rows="2">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kota</label>
                                <input name="kota" value="{{ old('kota') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Kota" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Provinsi</label>
                                <input name="provinsi" value="{{ old('provinsi') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Provinsi" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kode Pos</label>
                                <input name="kode_pos" value="{{ old('kode_pos') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Kode pos" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Details -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">business_center</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Detail Bisnis</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Perusahaan</label>
                                <input name="perusahaan" value="{{ old('perusahaan') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Perusahaan atau organisasi" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jabatan / Posisi</label>
                                <input name="jabatan" value="{{ old('jabatan') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Kepala Desain" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">note</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Catatan</h3>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Catatan Internal</label>
                        <textarea name="catatan" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Catatan penting tentang pelanggan: preferensi, kisaran anggaran, permintaan khusus..." rows="4">{{ old('catatan') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-span-4">
                <div class="sticky top-28 space-y-6">
                    <!-- Avatar Preview -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm text-center">
                        <div class="w-28 h-28 rounded-xl bg-primary-container mx-auto mb-4 flex items-center justify-center" id="avatarPreview">
                            <span class="material-symbols-outlined text-4xl text-primary">person</span>
                        </div>
                        <p class="text-sm font-bold text-on-surface">Pelanggan Baru</p>
                        <p class="text-xs text-on-surface-variant mt-1">Preview nama akan muncul di sini</p>
                    </div>

                    <!-- Loyalty Tier -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Tingkat Loyalitas</h4>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                                <input {{ old('status_loyalitas', 'baru') == 'baru' ? 'checked' : '' }} name="status_loyalitas" value="baru" type="radio" class="text-primary focus:ring-primary"/>
                                <div>
                                    <p class="text-sm font-bold text-on-surface">Pelanggan Baru</p>
                                    <p class="text-[10px] text-on-surface-variant">Pelanggan pertama kali</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                                <input {{ old('status_loyalitas') == 'reguler' ? 'checked' : '' }} name="status_loyalitas" value="reguler" type="radio" class="text-primary focus:ring-primary"/>
                                <div>
                                    <p class="text-sm font-bold text-on-surface">Reguler</p>
                                    <p class="text-[10px] text-on-surface-variant">1-2 pembelian sebelumnya</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-primary/10 rounded-lg cursor-pointer border border-primary/20 hover:bg-primary/15 transition-colors">
                                <input {{ old('status_loyalitas') == 'vip' ? 'checked' : '' }} name="status_loyalitas" value="vip" type="radio" class="text-primary focus:ring-primary"/>
                                <div>
                                    <p class="text-sm font-bold text-primary">VIP</p>
                                    <p class="text-[10px] text-on-surface-variant">3+ pembelian, pelanggan utama</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
