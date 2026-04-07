@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
    <!-- Main Content Canvas -->
    <div class="pt-28 p-10 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-4xl font-extrabold text-primary mb-2 tracking-tight">Daftar Proyek</h2>
                    <p class="text-on-surface-variant font-medium">Pantau semua pesanan dan proyek pengerjaan furniture Anda.</p>
                </div>
                <div class="flex gap-3">
                    <a class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 shadow-lg shadow-primary/10 hover:scale-105 transition-transform"
                        href="{{ route('projects.create') }}">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        Tambah Proyek
                    </a>
                </div>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-400 text-white rounded-lg font-medium shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-12 gap-8">
                <!-- Projects List Section -->
                <div class="col-span-12 space-y-6">
                    <!-- Stats Bar -->
                    <div class="grid grid-cols-4 gap-6">
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Proyek</p>
                            <h3 class="text-3xl font-black text-primary">{{ $totalProjects }}</h3>
                        </div>
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Proyek Aktif</p>
                            <h3 class="text-3xl font-black text-primary">{{ $activeProjects }}</h3>
                        </div>
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Selesai</p>
                            <h3 class="text-3xl font-black text-primary">{{ $completedProjects }}</h3>
                        </div>
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Tertunda</p>
                            <h3 class="text-3xl font-black text-primary">{{ $delayedProjects }}</h3>
                        </div>
                    </div>

                    <!-- Filters Bar -->
                    <form action="{{ route('projects.index') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="{{ route('projects.index') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ !request()->hasAny(['status', 'jenis', 'prioritas', 'search', 'sort']) ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                                Semua Proyek
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->except('page'), ['status' => 'aktif'])) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'aktif' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                                Aktif
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->except('page'), ['status' => 'selesai'])) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'selesai' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                                Selesai
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->except('page'), ['status' => 'ditunda'])) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all {{ request('status') == 'ditunda' ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 hover:bg-primary/5' }}">
                                Ditunda
                            </a>
                        </div>
                        <div class="ml-auto flex items-center gap-3">
                            <select name="jenis" onchange="this.form.submit()" class="px-4 py-2.5 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                                <option value="">Semua Jenis</option>
                                <option value="komisi_kustom" {{ request('jenis') == 'komisi_kustom' ? 'selected' : '' }}>Komisi Kustom</option>
                                <option value="produksi_stok" {{ request('jenis') == 'produksi_stok' ? 'selected' : '' }}>Produksi Stok</option>
                                <option value="restorasi" {{ request('jenis') == 'restorasi' ? 'selected' : '' }}>Restorasi</option>
                                <option value="renovasi" {{ request('jenis') == 'renovasi' ? 'selected' : '' }}>Renovasi</option>
                            </select>
                            <select name="sort" onchange="this.form.submit()" class="px-4 py-2.5 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline Terdekat</option>
                                <option value="progress_terendah" {{ request('sort') == 'progress_terendah' ? 'selected' : '' }}>Progress Terendah</option>
                                <option value="progress_tertinggi" {{ request('sort') == 'progress_tertinggi' ? 'selected' : '' }}>Progress Tertinggi</option>
                            </select>
                        </div>
                    </form>

                    <!-- Active Filters Display -->
                    @if(request()->hasAny(['search', 'jenis', 'sort']))
                    <div class="flex items-center gap-2 mb-6 flex-wrap">
                        <span class="text-xs font-bold text-outline uppercase">Filter Aktif:</span>
                        @if(request('search'))
                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                            Cari: "{{ request('search') }}"
                            <a href="{{ route('projects.index', request()->except(['search', 'page'])) }}" class="hover:text-error">&times;</a>
                        </span>
                        @endif
                        @if(request('jenis'))
                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                            Jenis: {{ ucfirst(str_replace('_', ' ', request('jenis'))) }}
                            <a href="{{ route('projects.index', request()->except(['jenis', 'page'])) }}" class="hover:text-error">&times;</a>
                        </span>
                        @endif
                        @if(request('sort') && request('sort') !== 'terbaru')
                        <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1">
                            Urutkan: {{ str_replace('_', ' ', ucfirst(request('sort'))) }}
                            <a href="{{ route('projects.index', request()->except(['sort', 'page'])) }}" class="hover:text-error">&times;</a>
                        </span>
                        @endif
                        @if(request()->hasAny(['search', 'jenis', 'sort']))
                        <a href="{{ route('projects.index') }}" class="px-3 py-1 text-xs font-bold text-error hover:underline">Reset Semua</a>
                        @endif
                    </div>
                    @endif

                    <!-- Main List Card -->
                    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="">
                                    <tr class="text-on-surface-variant/60 text-xs font-bold uppercase tracking-wider">
                                        <th class="px-6 py-4">Nama Proyek</th>
                                        <th class="px-6 py-4">Pelanggan</th>
                                        <th class="px-6 py-4">Jenis</th>
                                        <th class="px-6 py-4">No Faktur</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4">Progress</th>
                                        <th class="px-6 py-4 text-right"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @forelse($projects as $i => $project)
                                        <tr class="group hover:bg-surface-container-low transition-colors {{ $i % 2 === 1 ? 'bg-surface-container-low/30' : '' }}">
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <p class="font-bold text-on-surface">{{ $project->nama }}</p>
                                                    <p class="text-xs text-on-surface-variant">Tenggat: {{ $project->target_selesai ? $project->target_selesai->format('d M Y') : '-' }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 flex-shrink-0 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-xs font-bold">
                                                        {{ $project->customer ? $project->customer->initials : '-' }}
                                                    </div>
                                                    <p class="font-semibold text-on-surface text-sm">{{ $project->customer ? $project->customer->nama : 'Tidak Diketahui' }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <p class="text-sm font-semibold text-on-surface">{{ ucfirst(str_replace('_', ' ', $project->jenis)) }}</p>
                                            </td>
                                            <td class="px-6 py-5">
                                                <p class="text-sm font-bold text-outline">{{ $project->nomor_faktur ? '#' . $project->nomor_faktur : '-' }}</p>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full {{ $project->status_class }} text-[11px] font-bold uppercase tracking-wider">
                                                    {{ $project->status_label }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-1 h-2 bg-surface-container-high rounded-full overflow-hidden w-24">
                                                        <div class="h-full bg-primary rounded-full transition-all duration-1000" style="width: {{ $project->progress }}%"></div>
                                                    </div>
                                                    <span class="text-xs font-bold {{ $project->progress === 100 ? 'text-primary' : 'text-on-surface-variant' }}">{{ $project->progress }}%</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 flex items-center justify-end gap-2 text-right">
                                                <a href="{{ route('projects.show', $project->id) }}"
                                                    class="text-outline hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined">chevron_right</span>
                                                </a>    
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-10 text-center text-on-surface-variant">
                                                <span class="material-symbols-outlined text-4xl mb-2 opacity-50">inventory_2</span>
                                                <p>Belum ada proyek yang terdaftar.</p>
                                                @if(request()->hasAny(['status', 'jenis', 'search']))
                                                <a href="{{ route('projects.index') }}" class="mt-3 inline-block text-primary font-bold hover:underline">Reset Filter</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($projects->hasPages())
                        <div class="p-4 border-t border-stone-100 flex items-center justify-between">
                            <p class="text-xs font-medium text-on-surface-variant">Menampilkan {{ $projects->firstItem() }}-{{ $projects->lastItem() }} dari {{ $projects->total() }} Proyek</p>
                            <div>{{ $projects->links() }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
