@extends('layouts.app')

@section('title', 'Pengaturan')
@section('body-class', 'flex')

@section('content')
<div class="wood-grain-overlay absolute inset-0 pointer-events-none"></div>

<!-- Content Canvas -->
<div class="pt-28 px-10 pb-20">
    <div class="max-w-6xl mx-auto space-y-12">
        <!-- Profile Hero Section -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 bg-surface-container-lowest rounded-xl p-10 flex flex-col md:flex-row gap-10 items-start md:items-center relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-secondary-container/20 rounded-full blur-3xl group-hover:bg-secondary-container/40 transition-colors duration-700"></div>
                <div class="relative">
                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-xl overflow-hidden shadow-2xl rotate-3 transition-transform group-hover:rotate-0 duration-500">
                        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRqC-TvVYpbUEvjwJqRZACZQqEg59kTR3V3VAfb6r68ZF5SWqjVVR3yEUvrmFeHMvHwYA_KnqNgK-VMvNz3LdmhiONtmLdYBYzp8Fg04q1RKymSIgNCCMGStqeuCS-bRHdVIAiU-KtdLsN9eQXD-5FXUBAZwkwENHBnWpzReC7lIT78uDuFJuAbnh8kvhCNWThvhGsYEIDjJUquQZZ_Q3LSbDxoRX1Yp1x3L-hvrEcAyqKfeuepWBdfRtvN18SSOIGc2lltzDGI8QX"/>
                    </div>
                    <a class="absolute -bottom-2 -right-2 bg-primary text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform" href="{{ route('profile') }}">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                </div>
                <div class="flex-1 space-y-4">
                    <div>
                        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Elias Thorne</h2>
                        <p class="text-on-surface-variant font-medium text-lg">Lead Carpenter & Founder</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-1.5 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                            Tukang Ahli
                        </span>
                        <span class="px-4 py-1.5 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            Portland Atelier
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-sm leading-relaxed max-w-md">
                        Berdedikasi untuk melestarikan teknik pertukangan tradisional sambil mengintegrasikan estetika desain modern ke dalam setiap karya khusus.
                    </p>
                </div>
            </div>
            <div class="lg:col-span-4 grid grid-rows-2 gap-8">
                <div class="bg-primary text-white rounded-xl p-8 flex flex-col justify-between relative overflow-hidden">
                    <span class="material-symbols-outlined opacity-20 absolute -right-4 -bottom-4 text-9xl">handyman</span>
                    <div class="relative">
                        <p class="text-xs uppercase tracking-[0.2em] font-bold opacity-80">Total Proyek</p>
                        <p class="text-4xl font-black font-headline mt-1">142</p>
                    </div>
                    <div class="relative flex items-center gap-2 text-xs font-medium">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        12 selesai bulan ini
                    </div>
                </div>
                <div class="bg-secondary-container text-on-secondary-container rounded-xl p-8 flex flex-col justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] font-bold opacity-80">Rating Pelanggan</p>
                        <p class="text-4xl font-black font-headline mt-1">4.9<span class="text-lg opacity-50">/5</span></p>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-secondary-container bg-surface-container-highest"></div>
                        <div class="w-8 h-8 rounded-full border-2 border-secondary-container bg-surface-container-highest"></div>
                        <div class="w-8 h-8 rounded-full border-2 border-secondary-container bg-surface-container-highest"></div>
                        <div class="w-8 h-8 rounded-full border-2 border-secondary-container bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">+28</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Settings Modules -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">business_center</span>
                    </div>
                    <h3 class="text-2xl font-bold font-headline">Pengaturan Bisnis</h3>
                </div>
                <div class="bg-surface-container-low rounded-xl p-2 space-y-2">
                    <div class="p-6 bg-surface-container-lowest rounded-lg group hover:shadow-sm transition-all">
                        <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-2">Nama Bengkel</label>
                        <div class="flex justify-between items-center">
                            <p class="font-semibold text-lg">The Artisanal Atelier - Portland</p>
                            <span class="material-symbols-outlined text-outline cursor-pointer group-hover:text-primary transition-colors">chevron_right</span>
                        </div>
                    </div>
                    <div class="p-6 bg-surface-container-lowest rounded-lg group hover:shadow-sm transition-all">
                        <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-2">Inventaris Kayu Utama</label>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full">Oak</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full">Walnut</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full">Maple</span>
                            <button onclick="openModal('modal-add-wood')" class="px-3 py-1 border border-outline/30 text-outline text-[10px] font-black uppercase rounded-full">+ Tambah Jenis</button>
                        </div>
                    </div>
                    <div class="p-6 bg-surface-container-lowest rounded-lg group hover:shadow-sm transition-all">
                        <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-2">Mata Uang & Satuan</label>
                        <div class="flex justify-between items-center">
                            <p class="font-semibold">IDR (Rp) — Sentimeter/Metrik</p>
                            <span class="material-symbols-outlined text-outline">settings_input_component</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">notifications_active</span>
                    </div>
                    <h3 class="text-2xl font-bold font-headline">Preferensi</h3>
                </div>
                <div class="space-y-6">
                    @php
                        $prefs = [
                            ['title' => 'Pembaruan Status Pesanan', 'desc' => 'Dapatkan notifikasi saat proyek furniture berubah tahapan.', 'checked' => true],
                            ['title' => 'Pesan Pelanggan', 'desc' => 'Notifikasi push real-time untuk pertanyaan langsung.', 'checked' => true],
                            ['title' => 'Akses Biometrik Bengkel', 'desc' => 'Login aman menggunakan sidik jari atau Face ID.', 'checked' => false],
                        ];
                    @endphp
                    @foreach($prefs as $pref)
                    <div class="flex items-center justify-between p-6 border-b border-outline-variant/30">
                        <div>
                            <h4 class="font-bold text-primary">{{ $pref['title'] }}</h4>
                            <p class="text-sm text-on-surface-variant">{{ $pref['desc'] }}</p>
                        </div>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input {{ $pref['checked'] ? 'checked' : '' }} class="sr-only peer" type="checkbox"/>
                            <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Danger Zone -->
        <section class="bg-error-container/20 rounded-xl p-8 border border-error/10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-1">
                    <h3 class="text-lg font-black text-error font-headline">Zona Berbahaya</h3>
                    <p class="text-sm text-on-surface-variant">Kelola penghapusan akun atau penutupan bengkel permanen.</p>
                </div>
                <div class="flex gap-4">
                    <button class="px-6 py-2.5 rounded-full text-error font-bold text-sm border border-error/30 hover:bg-error hover:text-white transition-all">Nonaktifkan Akun</button>
                    <button class="px-6 py-2.5 rounded-full bg-primary text-white font-bold text-sm shadow-xl shadow-primary/20 hover:scale-105 transition-transform">Simpan Semua Perubahan</button>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('modals')
@include('components.modal-add-wood')
@endsection
