@extends('layouts.app')

@section('title', 'Proyek Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('dashboard') }}">Dashboard</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Proyek Baru</span>
    </nav>

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Buat Proyek Baru</h2>
            <p class="text-on-surface-variant mt-1">Mulai komisi pertukangan kayu kustom baru</p>
        </div>
        <div class="flex gap-3">
            <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" href="{{ route('dashboard') }}">Batal</a>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">rocket_launch</span>
                Mulai Proyek
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <div class="col-span-8 space-y-8">
            <!-- Project Details -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">assignment</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Detail Proyek</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Proyek *</label>
                        <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Set Meja Makan Walnut Kustom — Rumah Anderson" type="text"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jenis Proyek *</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih jenis...</option>
                                <option>Komisi Kustom</option>
                                <option>Produksi Stok</option>
                                <option>Restorasi</option>
                                <option>Renovasi Ruangan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Pelanggan *</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih pelanggan...</option>
                                <option>Eleanor Vance</option>
                                <option>Marcus Sterling</option>
                                <option>Sienna Rossi</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi Proyek</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Jelaskan cakupan proyek, visi pelanggan, dan kebutuhan khusus..." rows="4"></textarea>
                    </div>
                </div>
            </div>

            <!-- Material & Specs -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">carpenter</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Material & Spesifikasi</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Material Terpilih</label>
                        <div class="flex flex-wrap gap-3">
                            @php
                                $materials = [
                                    ['name' => 'Black Walnut', 'color' => '#4a3728', 'selected' => true],
                                    ['name' => 'White Oak', 'color' => '#c19a6b', 'selected' => false],
                                    ['name' => 'Cherry', 'color' => '#96694c', 'selected' => false],
                                    ['name' => 'Mahogany', 'color' => '#4E2A1E', 'selected' => false],
                                    ['name' => 'Teak', 'color' => '#8E593C', 'selected' => false],
                                    ['name' => 'Pine', 'color' => '#E5D3B3', 'selected' => false],
                                ];
                            @endphp
                            @foreach($materials as $mat)
                            <button class="flex items-center gap-2 px-4 py-3 rounded-lg border-2 {{ $mat['selected'] ? 'border-primary bg-primary/5' : 'border-outline-variant/20 hover:border-primary/30' }} transition-all">
                                <div class="w-5 h-5 rounded-full" style="background-color: {{ $mat['color'] }}"></div>
                                <span class="text-xs font-bold {{ $mat['selected'] ? 'text-primary' : 'text-on-surface-variant' }}">{{ $mat['name'] }}</span>
                                @if($mat['selected'])
                                <span class="material-symbols-outlined text-primary text-sm">check</span>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kebutuhan Khusus</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="cth., Live edge, sambungan kupu-kupu, pola serat tertentu..." rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Milestones -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">flag</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Tahapan Proyek</h3>
                </div>
                <div class="space-y-4">
                    @php
                        $milestones = [
                            ['name' => 'Persetujuan Desain', 'icon' => 'draw', 'default' => true],
                            ['name' => 'Pengadaan Material', 'icon' => 'inventory', 'default' => true],
                            ['name' => 'Perakitan & Konstruksi', 'icon' => 'construction', 'default' => true],
                            ['name' => 'Pengamplasan & Finishing', 'icon' => 'auto_fix_high', 'default' => true],
                            ['name' => 'Inspeksi Kualitas', 'icon' => 'verified', 'default' => true],
                            ['name' => 'Pengiriman & Instalasi', 'icon' => 'local_shipping', 'default' => true],
                        ];
                    @endphp
                    @foreach($milestones as $ms)
                    <div class="flex items-center gap-4 p-4 bg-surface-container-low rounded-lg">
                        <span class="material-symbols-outlined text-primary">{{ $ms['icon'] }}</span>
                        <span class="text-sm font-bold text-on-surface flex-1">{{ $ms['name'] }}</span>
                        <input class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium w-36" placeholder="Perkiraan tanggal" type="date"/>
                        <button class="text-outline hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    @endforeach
                    <button class="w-full py-3 border-2 border-dashed border-outline-variant/40 rounded-lg text-primary font-bold text-sm hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Tambah Tahapan Kustom
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Budget & Timeline -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Anggaran & Jadwal</h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Perkiraan Anggaran (Rp)</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0.00" type="number"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tanggal Mulai</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Target Selesai</label>
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                    </div>
                </div>

                <!-- Assign Team -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tugaskan Pengrajin</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input checked class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <img alt="Julian" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZDSDOiwRhwyGRYIJa7mN0i0g8bMKdMesH2MCjvR7uoG2m0eylA2zJ52G6c8Mdj7wpdPXQRLEB_tIXCf-NZW85oYym2hAI2kUzXCZGSIsD1P-vIeRUg8rH5OikpzVjATgA4kMQmck8s5fPaSBZ-3Tgw4kRuR33NsG1iV0HYbFu0I15eY1TTDxOXebh6Y6qpL9xhvsUYeN_mbph7_pUC-N-IPOYcxwegXy3G-_7LO06mijAu1Pqa_N2KTvVRT3reejJwvFLBeRDeP3"/>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Julian Thorne</p>
                                <p class="text-[10px] text-on-surface-variant">Tukang Kayu Utama</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-[10px] font-bold">MR</div>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Marco Rivera</p>
                                <p class="text-[10px] text-on-surface-variant">Spesialis Finishing</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-[10px] font-bold">AK</div>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Aisha Khan</p>
                                <p class="text-[10px] text-on-surface-variant">Konsultan Desain</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Priority -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tingkat Prioritas</h4>
                    <div class="grid grid-cols-3 gap-2">
                        <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-primary/30 transition-all">Standar</button>
                        <button class="py-3 text-center rounded-lg border-2 border-primary bg-primary/5 text-xs font-bold text-primary">Tinggi</button>
                        <button class="py-3 text-center rounded-lg border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant hover:border-error/30 hover:text-error transition-all">Mendesak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
