@extends('layouts.pelanggan')

@section('title', 'Detail Proyek')
@section('page-title', $project->nama)
@section('page-subtitle', $project->nomor_faktur)

@section('content')
    {{-- Back --}}
    <a href="{{ route('pelanggan.proyek.index') }}" class="inline-flex items-center gap-2 text-sm text-on-surface-variant hover:text-primary transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Kembali ke Proyek
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Project Info --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-on-surface font-headline">{{ $project->nama }}</h2>
                        <p class="text-sm text-on-surface-variant mt-1">
                            {{ $project->nomor_faktur }} • {{ ucfirst(str_replace('_', ' ', $project->jenis)) }}
                        </p>
                    </div>
                    <span class="px-5 py-2 text-sm font-bold rounded-full {{ $project->status_class }}">
                        {{ $project->status_label }}
                    </span>
                </div>

                {{-- Progress Bar --}}
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-on-surface">Progress</span>
                        <span class="text-2xl font-extrabold text-primary font-headline">{{ $project->progress }}%</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-4">
                        <div class="bg-gradient-to-r from-primary-container to-primary h-4 rounded-full transition-all duration-500" style="width: {{ $project->progress }}%"></div>
                    </div>
                </div>

                @if($project->deskripsi)
                    <div class="bg-surface-container-low rounded-xl p-4 mb-4">
                        <h3 class="text-xs font-bold text-on-surface uppercase tracking-wider mb-2">Deskripsi</h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $project->deskripsi }}</p>
                    </div>
                @endif
            </div>

            {{-- Milestones --}}
            @if($totalMilestones > 0)
                <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-on-surface font-headline">Tahapan Proyek</h3>
                        <span class="text-sm text-on-surface-variant">{{ $completedMilestones }}/{{ $totalMilestones }} selesai</span>
                    </div>
                    <div class="space-y-4">
                        @foreach($milestones as $milestone)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $milestone->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : ($milestone->status === 'in_progress' ? 'bg-primary/10 text-primary' : 'bg-surface-container text-outline') }}">
                                    <span class="material-symbols-outlined text-lg">
                                        {{ $milestone->status === 'selesai' ? 'check_circle' : ($milestone->status === 'in_progress' ? 'pending' : 'radio_button_unchecked') }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0 pt-1">
                                    <p class="text-sm font-bold text-on-surface {{ $milestone->status === 'selesai' ? 'line-through text-on-surface-variant' : '' }}">{{ $milestone->nama }}</p>
                                    <div class="flex items-center gap-3 mt-1">
                                        @if($milestone->tanggal_target)
                                            <span class="text-xs text-on-surface-variant">Target: {{ \Carbon\Carbon::parse($milestone->tanggal_target)->format('d M Y') }}</span>
                                        @endif
                                        @if($milestone->tanggal_selesai)
                                            <span class="text-xs text-emerald-600">✓ {{ \Carbon\Carbon::parse($milestone->tanggal_selesai)->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Review CTA --}}
            @if($project->status === 'selesai' && empty($project->rating))
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl border border-amber-200/50 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-600 text-2xl">rate_review</span>
                            <div>
                                <h3 class="font-bold text-on-surface">Berikan Ulasan</h3>
                                <p class="text-xs text-on-surface-variant">Proyek telah selesai. Beri masukan untuk kami!</p>
                            </div>
                        </div>
                        <a href="{{ route('pelanggan.ulasan.create', ['type' => 'project', 'id' => $project->id]) }}"
                           class="px-6 py-3 bg-primary text-on-primary font-bold text-sm rounded-full hover:bg-primary-container transition-colors">
                            Tulis Ulasan
                        </a>
                    </div>
                </div>
            @elseif(!empty($project->rating))
                <div class="bg-emerald-50 rounded-2xl border border-emerald-200/50 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                        <h3 class="font-bold text-emerald-800">Ulasan Anda</h3>
                    </div>
                    <div class="flex items-center gap-1 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined text-lg {{ $i <= $project->rating ? 'text-amber-500' : 'text-outline/30' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                        @endfor
                        <span class="text-sm font-bold text-on-surface ml-2">{{ $project->rating }}/5</span>
                    </div>
                    @if($project->keluhan_masukan)
                        <p class="text-sm text-on-surface-variant italic">"{{ $project->keluhan_masukan }}"</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Timeline --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <h3 class="font-bold text-on-surface font-headline mb-4">Timeline</h3>
                <div class="space-y-4 text-sm">
                    @if($project->tanggal_mulai)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Tanggal Mulai</p>
                            <p class="font-bold text-on-surface">{{ $project->tanggal_mulai->format('d M Y') }}</p>
                        </div>
                    @endif
                    @if($project->target_selesai)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Target Selesai</p>
                            <p class="font-bold text-on-surface">{{ $project->target_selesai->format('d M Y') }}</p>
                        </div>
                    @endif
                    @if($project->tanggal_selesai)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Tanggal Selesai</p>
                            <p class="font-bold text-emerald-700">{{ $project->tanggal_selesai->format('d M Y') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Details --}}
            <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                <h3 class="font-bold text-on-surface font-headline mb-4">Detail Proyek</h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Prioritas</p>
                        <p class="font-bold text-on-surface capitalize">{{ str_replace('_', ' ', $project->prioritas) }}</p>
                    </div>
                    @if($project->anggaran)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Anggaran</p>
                            <p class="font-extrabold text-primary text-lg">Rp {{ number_format($project->anggaran, 0, ',', '.') }}</p>
                        </div>
                    @endif
                    @if($project->kebutuhan_khusus)
                        <div>
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1">Kebutuhan Khusus</p>
                            <p class="text-on-surface">{{ $project->kebutuhan_khusus }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Specs --}}
            @if($project->panjang || $project->lebar || $project->tinggi || $project->finishing)
                <div class="bg-white rounded-2xl border border-outline-variant/20 p-6">
                    <h3 class="font-bold text-on-surface font-headline mb-4">Spesifikasi</h3>
                    <div class="space-y-3 text-sm">
                        @if($project->panjang || $project->lebar || $project->tinggi)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">straighten</span>
                                <span>{{ $project->panjang ?? '-' }} × {{ $project->lebar ?? '-' }} × {{ $project->tinggi ?? '-' }} cm</span>
                            </div>
                        @endif
                        @if($project->finishing)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">format_paint</span>
                                <span>{{ $project->finishing }}</span>
                            </div>
                        @endif
                        @if($project->berat)
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">scale</span>
                                <span>{{ $project->berat }} kg</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
