@extends('layouts.pelanggan')

@section('title', 'Proyek Saya')
@section('page-title', 'Proyek Saya')
@section('page-subtitle', 'Pantau progress proyek kustom Anda')

@section('content')
    {{-- Filter --}}
    <form method="GET" action="{{ route('pelanggan.proyek.index') }}" class="mb-8">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-xl">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama proyek..."
                        class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant/30 rounded-xl text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all" />
                </div>
            </div>
            <select name="status" class="bg-white border border-outline-variant/30 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Status</option>
                <option value="perencanaan" {{ request('status') == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="ditunda" {{ request('status') == 'ditunda' ? 'selected' : '' }}>Ditunda</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold text-sm rounded-xl hover:bg-primary-container transition-colors">
                Filter
            </button>
        </div>
    </form>

    {{-- Projects List --}}
    @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->count() > 0)
        <div class="space-y-4">
            @foreach($projects as $project)
                <a href="{{ route('pelanggan.proyek.show', $project->id) }}"
                   class="block bg-white rounded-2xl border border-outline-variant/20 p-6 hover:shadow-lg hover:border-primary/30 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">handyman</span>
                            <div>
                                <h3 class="text-base font-bold text-on-surface font-headline">{{ $project->nama }}</h3>
                                <p class="text-xs text-on-surface-variant">
                                    {{ $project->nomor_faktur }}
                                    @if($project->jenis)
                                        • {{ ucfirst(str_replace('_', ' ', $project->jenis)) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 text-xs font-bold rounded-full {{ $project->status_class }}">
                                {{ $project->status_label }}
                            </span>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_right</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-6 text-sm text-on-surface-variant">
                            @if($project->target_selesai)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                                    Target: {{ $project->target_selesai->format('d M Y') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-32 bg-surface-container rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ $project->progress }}%"></div>
                            </div>
                            <span class="text-sm font-extrabold text-on-surface">{{ $project->progress }}%</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $projects->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-outline/30 mb-4">handyman</span>
            <p class="text-on-surface-variant font-medium">Belum ada proyek.</p>
        </div>
    @endif
@endsection
