@extends('layouts.app')

@section('title', 'Pengaturan')
@section('body-class', 'flex')

@section('content')
<div class="wood-grain-overlay absolute inset-0 pointer-events-none"></div>

<!-- Content Canvas -->
<div class="pt-28 px-10 pb-20">
    <div class="max-w-6xl mx-auto space-y-12">
        <!-- Profile Hero Section -->
            <form method="POST" action="{{ route('profile.update') }}" class="lg:col-span-12 space-y-12">
                @csrf
                @method('PUT')
                
                @if(session('success'))
                <div class="p-4 bg-green-500 text-white rounded-lg font-medium shadow-sm">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="p-4 bg-red-500 text-white rounded-lg font-medium shadow-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="bg-surface-container-lowest rounded-xl p-10 flex flex-col items-start relative overflow-hidden group">
                    <div class="absolute -top-12 -right-12 w-48 h-48 bg-secondary-container/20 rounded-full blur-3xl group-hover:bg-secondary-container/40 transition-colors duration-700"></div>
                    <div class="flex items-center gap-6 mb-8 relative w-full">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-xl overflow-hidden shadow-2xl bg-primary/20 flex items-center justify-center">
                                @if($user->avatar)
                                    <img class="w-full h-full object-cover" src="{{ $user->avatar }}"/>
                                @else
                                    <span class="text-white text-6xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <h2 class="text-3xl font-extrabold text-primary tracking-tight font-headline">Ubah Profil</h2>
                            <p class="text-on-surface-variant font-medium">Perbarui informasi profil dan kontak Anda.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface flex gap-1">Nama Lengkap <span class="text-error">*</span></label>
                            <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="name" required type="text" value="{{ old('name', $user->name) }}"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface flex gap-1">Email <span class="text-error">*</span></label>
                            <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="email" required type="email" value="{{ old('email', $user->email) }}"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface flex gap-1">Jabatan</label>
                            <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="jabatan" type="text" value="{{ old('jabatan', $user->jabatan) }}"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface flex gap-1">No. Telepon</label>
                            <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="telepon" type="text" value="{{ old('telepon', $user->telepon) }}"/>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-on-surface flex gap-1">URL Avatar (Profil Foto)</label>
                            <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="avatar_url" type="url" value="{{ old('avatar_url', $user->avatar) }}" placeholder="https://example.com/avatar.png"/>
                        </div>
                    </div>
                </div>

                <!-- Settings Modules -->
                <div class="grid grid-cols-1 gap-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 p-8 bg-surface-container-lowest rounded-xl">
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

        <!-- Change Password Section -->
        <section class="bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">lock</span>
                </div>
                <div>
                    <h3 class="text-2xl font-bold font-headline text-primary">Ubah Password</h3>
                    <p class="text-sm text-on-surface-variant">Perbarui password akun Anda untuk keamanan.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('settings.password') }}" class="space-y-6 max-w-lg">
                @csrf
                @method('PUT')
                @if($errors->has('current_password'))
                <div class="p-4 bg-error-container text-on-error-container rounded-lg text-sm">
                    {{ $errors->first('current_password') }}
                </div>
                @endif
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface flex gap-1">Password Saat Ini <span class="text-error">*</span></label>
                    <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="current_password" required type="password" placeholder="Masukkan password saat ini"/>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface flex gap-1">Password Baru <span class="text-error">*</span></label>
                    <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="password" required type="password" minlength="8" placeholder="Minimal 8 karakter"/>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface flex gap-1">Konfirmasi Password Baru <span class="text-error">*</span></label>
                    <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary transition-all font-body font-medium" name="password_confirmation" required type="password" minlength="8" placeholder="Ulangi password baru"/>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-bold text-sm shadow-xl shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">lock_reset</span>
                        Ubah Password
                    </button>
                </div>
            </form>
        </section>

        <!-- Danger Zone -->
        <section class="bg-error-container/20 rounded-xl p-8 border border-error/10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-1">
                    <h3 class="text-lg font-black text-error font-headline">Zona Berbahaya</h3>
                    <p class="text-sm text-on-surface-variant">Kelola penghapusan akun atau penutupan bengkel permanen.</p>
                </div>
                        <div class="flex gap-4">
                            <a href="{{ route('profile') }}" class="px-6 py-2.5 rounded-full text-on-surface font-bold text-sm border border-outline-variant hover:bg-surface-container-high transition-all">Batal</a>
                            <button type="submit" class="px-6 py-2.5 rounded-full bg-primary text-white font-bold text-sm shadow-xl shadow-primary/20 hover:scale-105 transition-transform">Simpan Semua Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection

@section('modals')
@include('components.modal-add-wood')
@endsection
