@extends('layouts.app')

@section('title', 'Ubah Pelanggan')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Portofolio Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-on-surface-variant font-medium">Eleanor Vance</span>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Ubah</span>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Ubah Profil Pelanggan</h2>
            <p class="text-on-surface-variant mt-1">Perbarui detail dan preferensi pelanggan</p>
        </div>
        <div class="flex gap-3">
            <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" href="{{ route('customers') }}">Batal</a>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <div class="col-span-8 space-y-8">
            <!-- Personal Information (pre-filled) -->
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
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Depan</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" value="Eleanor"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Belakang</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" value="Vance"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Email</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">mail</span>
                                <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="email" value="e.vance@designhouse.com"/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nomor Telepon</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">call</span>
                                <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="tel" value="+1 (555) 234-8902"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 material-symbols-outlined text-outline text-[20px]">location_on</span>
                            <textarea class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="2">Greenwich Village, New York, NY 10014</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Details (pre-filled) -->
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
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" value="DesignHouse Studios"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jabatan / Posisi</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" value="Head of Design"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Sumber Referensi</label>
                        <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                            <option selected>Referensi</option>
                            <option>Media Sosial</option>
                            <option>Website</option>
                            <option>Pameran Dagang</option>
                            <option>Dari Mulut ke Mulut</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Catatan Internal</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="3">Prefers walnut and oak. Budget range $3,000-$15,000. Interested in live-edge pieces. Referred by Marcus Sterling.</textarea>
                    </div>
                </div>
            </div>

            <!-- Acquisition History (read-only) -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">history</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Riwayat Pembelian</h3>
                    <span class="px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-bold text-outline uppercase">Hanya Baca</span>
                </div>
                <div class="space-y-4">
                    @php
                        $history = [
                            ['item' => 'Set Meja Makan Walnut', 'amount' => '$12,400', 'date' => '12 Okt 2023', 'status' => 'Selesai', 'statusClass' => 'bg-emerald-100 text-emerald-800'],
                            ['item' => 'Kursi Baca', 'amount' => '$2,850', 'date' => '15 Mar 2023', 'status' => 'Selesai', 'statusClass' => 'bg-emerald-100 text-emerald-800'],
                            ['item' => 'Rak Dinding Kustom', 'amount' => '$1,200', 'date' => '8 Jan 2023', 'status' => 'Selesai', 'statusClass' => 'bg-emerald-100 text-emerald-800'],
                        ];
                    @endphp
                    @foreach($history as $h)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg">
                        <div>
                            <p class="text-sm font-bold text-on-surface">{{ $h['item'] }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $h['date'] }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-primary">{{ $h['amount'] }}</span>
                            <span class="px-3 py-1 {{ $h['statusClass'] }} text-[10px] font-bold uppercase rounded-full">{{ $h['status'] }}</span>
                        </div>
                    </div>
                    @endforeach
                    <div class="pt-4 border-t border-outline-variant/20 flex justify-between items-center">
                        <span class="text-xs font-bold text-outline uppercase tracking-widest">Total Nilai Seumur Hidup</span>
                        <span class="text-xl font-black text-primary font-headline">$16,450.00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Client Photo -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm text-center">
                    <div class="w-28 h-28 rounded-xl mx-auto mb-4 overflow-hidden relative group cursor-pointer">
                        <img alt="Eleanor Vance" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8BqnZFBl0JSAaA6lYT3nJaQDuS2n0y1gAChCI30SfFvb_wqRk3BxIosw9O7Uk2N8SitQrO5MpbB1Xuuau7fcoA9ZPOVxAOdArrPFtXeCrqJDmwK8JXeGbpfOlyE0kY71GWoYSQMCN-dD80qMSKqE_pa-3nxkwKa9qqh3GTuGXKw86aXTV2sPLkqZ858Dep1OcedeMClqWQTo0wTrLZ4qF5JTEpwMVa-VnscfjXlScpI3jUeK3c9dn0pzScRbTUVPyo7F0lhWPIWUo"/>
                        <div class="absolute inset-0 bg-primary/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-on-primary text-2xl">edit</span>
                        </div>
                    </div>
                    <p class="text-lg font-bold text-on-surface">Eleanor Vance</p>
                    <p class="text-xs text-on-surface-variant">Pelanggan sejak Jan 2023</p>
                </div>

                <!-- Current Tier -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tingkat Loyalitas</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <span class="text-sm font-medium text-on-surface">Pelanggan Baru</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <span class="text-sm font-medium text-on-surface">Dasar</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-primary/10 rounded-lg cursor-pointer border border-primary/20">
                            <input checked class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <div>
                                <span class="text-sm font-bold text-primary">Lingkaran Elite</span>
                                <span class="material-symbols-outlined text-primary text-sm ml-1 align-middle" style="font-variation-settings: 'FILL' 1;">verified</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="tier" type="radio"/>
                            <span class="text-sm font-medium text-on-surface">Duta</span>
                        </label>
                    </div>
                </div>

                <!-- Communication -->
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
                                <input checked class="sr-only peer" type="checkbox"/>
                                <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                    <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                    <p class="text-xs text-on-surface-variant mb-4">Hapus pelanggan ini dan semua catatannya secara permanen.</p>
                    <button class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">delete_forever</span>
                        Hapus Pelanggan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
