@extends('layouts.app')

@section('title', 'Tambah Pelanggan Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Portofolio Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Pelanggan Baru</span>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Daftarkan Pelanggan Baru</h2>
            <p class="text-on-surface-variant mt-1">Tambahkan pelanggan baru ke portofolio Anda</p>
        </div>
        <div class="flex gap-3">
            <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" href="{{ route('customers') }}">Batal</a>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
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
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Depan *</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Nama depan" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Belakang *</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Nama belakang" type="text"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Email *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">mail</span>
                                <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="name@company.com" type="email"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nomor Telepon</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">call</span>
                                <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="+1 (555) 000-0000" type="tel"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 material-symbols-outlined text-outline text-[20px]">location_on</span>
                            <textarea class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Alamat lengkap..." rows="2"></textarea>
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
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Perusahaan atau organisasi" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jabatan / Posisi</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Kepala Desain" type="text"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Bagaimana Mereka Menemukan Kami?</label>
                        <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                            <option value="">Pilih sumber...</option>
                            <option>Referensi</option>
                            <option>Media Sosial</option>
                            <option>Website</option>
                            <option>Pameran Dagang</option>
                            <option>Dari Mulut ke Mulut</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">favorite</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Preferensi & Catatan</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Jenis Kayu Favorit</label>
                        <div class="flex flex-wrap gap-3">
                            @php
                                $woods = [
                                    ['name' => 'Walnut', 'color' => '#4a3728'],
                                    ['name' => 'Oak', 'color' => '#c19a6b'],
                                    ['name' => 'Cherry', 'color' => '#96694c'],
                                    ['name' => 'Mahogany', 'color' => '#4E2A1E'],
                                    ['name' => 'Teak', 'color' => '#8E593C'],
                                    ['name' => 'Pine', 'color' => '#E5D3B3'],
                                    ['name' => 'Maple', 'color' => '#D2B48C'],
                                ];
                            @endphp
                            @foreach($woods as $wood)
                            <button class="flex items-center gap-2 px-4 py-3 rounded-lg border-2 border-outline-variant/20 hover:border-primary/30 transition-all">
                                <div class="w-4 h-4 rounded-full" style="background-color: {{ $wood['color'] }}"></div>
                                <span class="text-xs font-bold text-on-surface-variant">{{ $wood['name'] }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Preferensi Gaya</label>
                        <div class="grid grid-cols-4 gap-3">
                            <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-primary/30 transition-all">Modern</button>
                            <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-primary/30 transition-all">Tradisional</button>
                            <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-primary/30 transition-all">Rustic</button>
                            <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-primary/30 transition-all">Minimalis</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Catatan Internal</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Catatan penting tentang pelanggan: preferensi, kisaran anggaran, permintaan khusus..." rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Avatar Upload -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm text-center">
                    <div class="w-28 h-28 rounded-xl bg-surface-container-high mx-auto mb-4 flex items-center justify-center group cursor-pointer hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-4xl text-outline group-hover:text-primary transition-colors">add_a_photo</span>
                    </div>
                    <p class="text-sm font-bold text-on-surface">Unggah Foto</p>
                    <p class="text-xs text-on-surface-variant mt-1">JPG atau PNG, maks 5MB</p>
                </div>

                <!-- Loyalty Tier -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tingkat Loyalitas</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <div>
                                <p class="text-sm font-bold text-on-surface">Pelanggan Baru</p>
                                <p class="text-[10px] text-on-surface-variant">Pelanggan pertama kali</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input checked class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <div>
                                <p class="text-sm font-bold text-on-surface">Dasar</p>
                                <p class="text-[10px] text-on-surface-variant">1-2 pembelian sebelumnya</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <div>
                                <p class="text-sm font-bold text-on-surface">Lingkaran Elite</p>
                                <p class="text-[10px] text-on-surface-variant">3+ pembelian, VIP</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-primary/10 rounded-lg cursor-pointer border border-primary/20">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <div>
                                <p class="text-sm font-bold text-primary">Duta</p>
                                <p class="text-[10px] text-on-surface-variant">Pelanggan utama, partner referensi</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Communication Preferences -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Komunikasi</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm font-medium text-on-surface">Pembaruan Email</span>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input checked class="sr-only peer" type="checkbox"/>
                                <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm font-medium text-on-surface">Notifikasi SMS</span>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox"/>
                                <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
