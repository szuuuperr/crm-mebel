@extends('layouts.app')

@section('title', 'Lacak Proyek')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('dashboard') }}">Dashboard</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Pelacak Proyek</span>
    </nav>

    <!-- Project Header -->
    <div class="bg-primary rounded-xl p-10 mb-10 relative overflow-hidden">
        <div class="absolute -right-16 -bottom-16 opacity-10">
            <span class="material-symbols-outlined text-[200px]">carpenter</span>
        </div>
        <div class="relative z-10 flex justify-between items-start">
            <div class="text-on-primary">
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 bg-white/20 text-xs font-bold uppercase tracking-wider rounded-full">Order #8821</span>
                    <span class="px-3 py-1 bg-amber-400/20 text-amber-200 text-xs font-bold uppercase tracking-wider rounded-full">Dalam Produksi</span>
                </div>
                <h1 class="text-3xl font-extrabold font-headline tracking-tight mb-2">Custom Walnut Dining Table</h1>
                <p class="text-on-primary/70 font-medium">Pelanggan: Eleanor Vance — Dimulai 1 Okt 2023</p>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-3 bg-white/10 hover:bg-white/20 text-on-primary font-bold rounded-full transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Ubah Proyek
                </button>
                <button class="px-6 py-3 bg-white text-primary font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">chat_bubble</span>
                    Hubungi Pelanggan
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <!-- Main Timeline -->
        <div class="col-span-8 space-y-8">
            <!-- Progress Bar -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-primary">Progres Produksi</h3>
                    <span class="text-2xl font-black text-primary font-headline">65%</span>
                </div>
                <div class="h-3 w-full bg-surface-container-high rounded-full overflow-hidden mb-8">
                    <div class="h-full bg-gradient-to-r from-primary to-primary-container rounded-full" style="width: 65%"></div>
                </div>

                <!-- Milestone Timeline -->
                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-outline-variant/20"></div>
                    @php
                        $milestones = [
                            ['name' => 'Persetujuan Desain', 'date' => '5 Okt 2023', 'status' => 'completed', 'icon' => 'draw', 'note' => 'Pelanggan menyetujui desain akhir dengan mockup 3D. Live-edge dipilih.'],
                            ['name' => 'Pengadaan Material', 'date' => '12 Okt 2023', 'status' => 'completed', 'icon' => 'inventory', 'note' => 'Slab Black Walnut premium diperoleh dari pemasok Oregon. Ketebalan 6,35 cm.'],
                            ['name' => 'Perakitan & Konstruksi', 'date' => '20 Okt 2023', 'status' => 'completed', 'icon' => 'construction', 'note' => 'Sambungan mortise & tenon selesai. Pengeleman meja atas selesai.'],
                            ['name' => 'Pengamplasan & Finishing', 'date' => 'Sedang Berlangsung', 'status' => 'active', 'icon' => 'auto_fix_high', 'note' => 'Lapisan pertama minyak tung telah diaplikasikan. Menunggu 48 jam untuk lapisan kedua.'],
                            ['name' => 'Inspeksi Kualitas', 'date' => 'Perkiraan 5 Nov 2023', 'status' => 'pending', 'icon' => 'verified', 'note' => ''],
                            ['name' => 'Pengiriman & Instalasi', 'date' => 'Perkiraan 10 Nov 2023', 'status' => 'pending', 'icon' => 'local_shipping', 'note' => ''],
                        ];
                    @endphp

                    @foreach($milestones as $ms)
                    <div class="relative flex gap-6 pb-8 last:pb-0">
                        <div class="relative z-10 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $ms['status'] === 'completed' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : '' }}
                            {{ $ms['status'] === 'active' ? 'bg-secondary-container text-on-secondary-container ring-4 ring-secondary-container/30' : '' }}
                            {{ $ms['status'] === 'pending' ? 'bg-surface-container-high text-outline' : '' }}
                        ">
                            @if($ms['status'] === 'completed')
                                <span class="material-symbols-outlined text-sm">check</span>
                            @else
                                <span class="material-symbols-outlined text-sm">{{ $ms['icon'] }}</span>
                            @endif
                        </div>
                        <div class="flex-1 {{ $ms['status'] === 'active' ? 'bg-secondary-container/20 p-6 rounded-xl border border-secondary-container/30 -mt-2' : '' }}">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold {{ $ms['status'] === 'pending' ? 'text-outline' : 'text-on-surface' }}">{{ $ms['name'] }}</h4>
                                <span class="text-xs font-medium {{ $ms['status'] === 'active' ? 'text-primary font-bold' : 'text-on-surface-variant' }}">{{ $ms['date'] }}</span>
                            </div>
                            @if($ms['note'])
                            <p class="text-sm text-on-surface-variant mt-1">{{ $ms['note'] }}</p>
                            @endif
                            @if($ms['status'] === 'active')
                            <div class="mt-4 flex gap-3">
                                <button class="px-4 py-2 bg-primary text-on-primary text-xs font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">add_photo_alternate</span>
                                    Tambah Foto Progres
                                </button>
                                <button class="px-4 py-2 bg-surface-container-lowest text-primary text-xs font-bold rounded-full border border-primary/20 hover:bg-primary/5 transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">check_circle</span>
                                    Tandai Selesai
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Activity Log -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Log Aktivitas</h3>
                <div class="space-y-4">
                    @php
                        $logs = [
                            ['time' => '2 jam lalu', 'user' => 'Julian Thorne', 'action' => 'Mengaplikasikan lapisan pertama minyak tung pada meja atas', 'icon' => 'brush', 'type' => 'update'],
                            ['time' => 'Kemarin', 'user' => 'Sistem', 'action' => 'Tahapan "Perakitan" ditandai selesai', 'icon' => 'task_alt', 'type' => 'milestone'],
                            ['time' => '3 hari lalu', 'user' => 'Julian Thorne', 'action' => 'Mengunggah 4 foto progres', 'icon' => 'photo_library', 'type' => 'photo'],
                            ['time' => '1 minggu lalu', 'user' => 'Eleanor Vance', 'action' => 'Meninggalkan komentar: "Terlihat luar biasa! Bisa pakai minyak yang lebih hangat?"', 'icon' => 'chat', 'type' => 'comment'],
                        ];
                    @endphp
                    @foreach($logs as $log)
                    <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-surface-container-low transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0
                            {{ $log['type'] === 'milestone' ? 'bg-primary/10 text-primary' : '' }}
                            {{ $log['type'] === 'update' ? 'bg-secondary-container text-on-secondary-container' : '' }}
                            {{ $log['type'] === 'photo' ? 'bg-surface-container-high text-primary' : '' }}
                            {{ $log['type'] === 'comment' ? 'bg-primary-fixed/30 text-primary' : '' }}
                        ">
                            <span class="material-symbols-outlined text-sm">{{ $log['icon'] }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm"><span class="font-bold text-on-surface">{{ $log['user'] }}</span> <span class="text-on-surface-variant">{{ $log['action'] }}</span></p>
                            <p class="text-xs text-outline mt-1">{{ $log['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="w-full mt-4 py-3 text-center text-sm font-bold text-primary hover:bg-primary/5 rounded-lg transition-colors">
                    Lihat Riwayat Lengkap
                </button>
            </div>

            <!-- Progress Photos -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-primary">Galeri Progres</h3>
                    <button class="text-sm font-bold text-primary hover:underline">Unggah Foto</button>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @php
                        $photos = [
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuBG7QyHUGiNALUJffjCdcNoPJMxyXq3icljT_Lrd6O0YiJixiBBMeYEh-X3DgfyZaDceQy1bXRpqksgvLv5KeG18YSg7hcs-HaigiLGo13TKHQHIr-7aof1N2lv5RcQSQ17EEaUIdLgwr2qlFSNUIY-DxjQnK17ASwCrzrW3XTSWLuEvkRmiSqq5xmYis8r-T-t1DRyWrwbaiNiBAVTAPH8HaiMFHNfLhKNOgJ-z9laZ2h3a0It5W5dxKGKv8SL8zBGmtAq3ecEnucC',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuBRB-7w255M5K63wx1wYZJmgo2g-eh9VFfDKXhkt1_6LyPQ0hB2_17W9JrkErqJ4ch5pI9vQLCWWDso05gE3zw4MfCJU_FK89ktZcQKJImvcIetRfndhBUlkLuwXSJgj2zwR7nn_5ohc5HRNQ5kemTjp5e70CwxEBtUd9lp5U41lQxJQFjNjPpCoBiqryhsXnWqWYzjM2gl2mdnarYG2jxyfSUM-tlfFGUQ9_65JLPNlwtJ4u8pPwCkoDOMoT__ExuQ1EnlZqH_1R67',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuCaPhpfV72j4BMFCT7R4Q8BzjgbZoAaXeKITk5TMeRWxS7Nt9UI2lMaPwVSc1f55yAJ06Ap5RSpEznfaaaAyzMW3opG0fEgiewI6dNC4IiPuRwsADS60OfVR2Kmf9OehwUqS10dhZQgVQbwPOf_L5jxnr0odvyxUSdCF-0NKffpe3roGsVQ9LHurcvXsvTGzIcl3W2NbtNJ51m4PsONf-76Z3MZxb77o9kFAR36iFKkX_yB0LJvBapbxpipjsJk83eWm1M-qjv5fQ1V',
                        ];
                    @endphp
                    @foreach($photos as $photo)
                    <div class="h-40 rounded-lg overflow-hidden group cursor-pointer">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $photo }}"/>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Client Card -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Informasi Pelanggan</h4>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-xl bg-primary-container overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8BqnZFBl0JSAaA6lYT3nJaQDuS2n0y1gAChCI30SfFvb_wqRk3BxIosw9O7Uk2N8SitQrO5MpbB1Xuuau7fcoA9ZPOVxAOdArrPFtXeCrqJDmwK8JXeGbpfOlyE0kY71GWoYSQMCN-dD80qMSKqE_pa-3nxkwKa9qqh3GTuGXKw86aXTV2sPLkqZ858Dep1OcedeMClqWQTo0wTrLZ4qF5JTEpwMVa-VnscfjXlScpI3jUeK3c9dn0pzScRbTUVPyo7F0lhWPIWUo"/>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">Eleanor Vance</p>
                            <p class="text-xs text-on-surface-variant">e.vance@designhouse.com</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                            <span class="text-on-surface font-medium">+1 (555) 234-8902</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                            <span class="text-on-surface font-medium">Greenwich Village, NY</span>
                        </div>
                    </div>
                </div>

                <!-- Project Info -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Detail Proyek</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Anggaran</span>
                            <span class="text-sm font-bold text-primary">$4,200.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Tanggal Mulai</span>
                            <span class="text-sm font-bold text-on-surface">Oct 1, 2023</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Target Selesai</span>
                            <span class="text-sm font-bold text-on-surface">Nov 10, 2023</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Sisa Hari</span>
                            <span class="text-sm font-bold text-error">17 Hari</span>
                        </div>
                    </div>
                </div>

                <!-- Team -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pengrajin Ditugaskan</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <img alt="Julian" class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZDSDOiwRhwyGRYIJa7mN0i0g8bMKdMesH2MCjvR7uoG2m0eylA2zJ52G6c8Mdj7wpdPXQRLEB_tIXCf-NZW85oYym2hAI2kUzXCZGSIsD1P-vIeRUg8rH5OikpzVjATgA4kMQmck8s5fPaSBZ-3Tgw4kRuR33NsG1iV0HYbFu0I15eY1TTDxOXebh6Y6qpL9xhvsUYeN_mbph7_pUC-N-IPOYcxwegXy3G-_7LO06mijAu1Pqa_N2KTvVRT3reejJwvFLBeRDeP3"/>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Julian Thorne</p>
                                <p class="text-[10px] text-on-surface-variant">Tukang Kayu Utama</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-xs font-bold">MR</div>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Marco Rivera</p>
                                <p class="text-[10px] text-on-surface-variant">Spesialis Finishing</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-3">Aksi Cepat</h4>
                    <div class="space-y-2">
                        <button class="w-full py-3 bg-surface-container-lowest text-primary font-bold rounded-lg text-sm hover:bg-primary hover:text-on-primary transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">receipt_long</span>
                            Buat Faktur
                        </button>
                        <button class="w-full py-3 bg-surface-container-lowest text-primary font-bold rounded-lg text-sm hover:bg-primary hover:text-on-primary transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">download</span>
                            Ekspor Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
