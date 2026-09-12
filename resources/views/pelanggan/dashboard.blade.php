@extends('layouts.pelanggan')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan aktivitas Anda')

@section('content')
    {{-- Welcome Card --}}
    <div class="bg-gradient-to-br from-primary-container to-primary rounded-2xl p-8 mb-8 relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-2xl font-extrabold text-on-primary font-headline mb-2">
                Selamat Datang, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="text-on-primary/80 text-sm">
                Pantau pesanan, proyek, dan berikan ulasan dari portal ini.
            </p>
        </div>
        <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/5 rounded-full"></div>
        <div class="absolute -right-4 -bottom-12 w-32 h-32 bg-white/5 rounded-full"></div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Pesanan Aktif --}}
        <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-amber-700 text-xl">local_shipping</span>
                </div>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Pesanan Aktif</span>
            </div>
            <p class="text-3xl font-extrabold text-on-surface font-headline">{{ $pesananAktif }}</p>
        </div>

        {{-- Proyek Aktif --}}
        <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-700 text-xl">construction</span>
                </div>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Proyek Aktif</span>
            </div>
            <p class="text-3xl font-extrabold text-on-surface font-headline">{{ $proyekAktif }}</p>
        </div>

        {{-- Selesai --}}
        <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-700 text-xl">check_circle</span>
                </div>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Selesai</span>
            </div>
            <p class="text-3xl font-extrabold text-on-surface font-headline">{{ $pesananSelesai + $proyekSelesai }}</p>
        </div>

        {{-- Belum Direview --}}
        <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-orange-700 text-xl">rate_review</span>
                </div>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Belum Direview</span>
            </div>
            <p class="text-3xl font-extrabold text-on-surface font-headline">{{ $belumDireview }}</p>
            @if($belumDireview > 0)
                <a href="{{ route('pelanggan.ulasan.index') }}" class="text-xs text-primary font-bold mt-2 inline-flex items-center gap-1 hover:underline">
                    Beri ulasan <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            @endif
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Pesanan Terbaru --}}
        <div class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden">
            <div class="p-6 border-b border-outline-variant/20 flex items-center justify-between">
                <h3 class="font-bold text-on-surface font-headline">Pesanan Terbaru</h3>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-outline-variant/10">
                @forelse($recentOrders as $order)
                    <a href="{{ route('pelanggan.pesanan.show', $order->id) }}" class="flex items-center justify-between p-4 hover:bg-surface-container-low transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">receipt_long</span>
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $order->nomor_faktur }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $order->tanggal_pesanan->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $order->status_class }}">
                            {{ $order->status_label }}
                        </span>
                    </a>
                @empty
                    <div class="p-8 text-center text-on-surface-variant text-sm">Belum ada pesanan.</div>
                @endforelse
            </div>
        </div>

        {{-- Proyek Terbaru --}}
        <div class="bg-white rounded-2xl border border-outline-variant/20 overflow-hidden">
            <div class="p-6 border-b border-outline-variant/20 flex items-center justify-between">
                <h3 class="font-bold text-on-surface font-headline">Proyek Terbaru</h3>
                <a href="{{ route('pelanggan.proyek.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-outline-variant/10">
                @forelse($recentProjects as $project)
                    <a href="{{ route('pelanggan.proyek.show', $project->id) }}" class="flex items-center justify-between p-4 hover:bg-surface-container-low transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">handyman</span>
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $project->nama }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $project->nomor_faktur }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-20 bg-surface-container rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full" style="width: {{ $project->progress }}%"></div>
                            </div>
                            <span class="text-xs font-bold text-on-surface-variant">{{ $project->progress }}%</span>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-on-surface-variant text-sm">Belum ada proyek.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
