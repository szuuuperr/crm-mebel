@extends('layouts.app')

@section('title', 'Detail Proyek - ' . $project->nama)

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('projects.index') }}">Proyek</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">{{ $project->nama }}</span>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-secondary-container text-on-secondary-container rounded-lg font-medium">
        {{ session('success') }}
    </div>
    @endif

    <!-- Project Header -->
    <div class="bg-primary rounded-xl p-10 mb-10 relative overflow-hidden">
        <div class="absolute -right-16 -bottom-16 opacity-10">
            <span class="material-symbols-outlined text-[200px]">carpenter</span>
        </div>
        <div class="relative z-10 flex justify-between items-start">
            <div class="text-on-primary">
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 bg-white/20 text-xs font-bold uppercase tracking-wider rounded-full">{{ $project->status_label }}</span>
                    @if($project->nomor_faktur)
                    <span class="px-3 py-1 bg-white/20 text-xs font-bold uppercase tracking-wider rounded-full">Proyek #{{ $project->nomor_faktur }}</span>
                    @endif
                    @if($project->order)
                    <span class="px-3 py-1 bg-white/20 text-xs font-bold uppercase tracking-wider rounded-full">Sales #{{ $project->order->nomor_faktur }}</span>
                    @endif
                </div>
                <h1 class="text-3xl font-extrabold font-headline tracking-tight mb-2">{{ $project->nama }}</h1>
                <p class="text-on-primary/70 font-medium">Pelanggan: {{ $project->customer->nama }} @if($project->tanggal_mulai)· Dimulai {{ $project->tanggal_mulai->translatedFormat('d M Y') }}@endif</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('projects.edit', $project->id) }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-on-primary font-bold rounded-full transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Ubah Proyek
                </a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-white text-primary font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <!-- Main Content -->
        <div class="col-span-8 space-y-8">
            <!-- Progress Bar -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-primary">Progres Produksi</h3>
                    <span class="text-2xl font-black text-primary font-headline">{{ $project->progress }}%</span>
                </div>
                <div class="h-3 w-full bg-surface-container-high rounded-full overflow-hidden mb-8">
                    <div class="h-full bg-primary rounded-full transition-all duration-500" style="width: {{ $project->progress }}%"></div>
                </div>

                <!-- Milestones -->
                @if($totalMilestones > 0)
                <div class="space-y-4">
                    <h4 class="text-sm font-bold text-outline uppercase tracking-widest">Tahapan Proyek</h4>
                    @foreach($milestones as $milestone)
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $milestone->status === 'selesai' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-outline' }}">
                            <span class="material-symbols-outlined text-sm">{{ $milestone->status === 'selesai' ? 'check' : 'pending' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-on-surface">{{ $milestone->nama }}</p>
                            @if($milestone->target_selesai)
                            <p class="text-xs text-on-surface-variant">Target: {{ $milestone->target_selesai->translatedFormat('d M Y') }}</p>
                            @endif
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $milestone->status === 'selesai' ? 'bg-primary/10 text-primary' : 'bg-surface-container text-outline' }}">
                            {{ $milestone->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-sm text-on-surface-variant">Belum ada tahapan yang dibuat.</p>
                @endif
            </div>

            <!-- Description -->
            @if($project->deskripsi)
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Deskripsi</h3>
                <p class="text-on-surface-variant leading-relaxed">{{ $project->deskripsi }}</p>
            </div>
            @endif

            @if($project->kebutuhan_khusus)
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Kebutuhan Khusus</h3>
                <p class="text-on-surface-variant leading-relaxed">{{ $project->kebutuhan_khusus }}</p>
            </div>
            @endif

            <!-- Feedback -->
            @if($project->status === 'selesai' && !$project->rating && !$project->keluhan_masukan)
            <div class="bg-primary/5 rounded-xl p-8 border border-primary/20">
                <h3 class="text-xl font-bold text-primary mb-2">Beri Penilaian Proyek</h3>
                <p class="text-sm text-on-surface-variant mb-6">Bagaimana hasil dari proyek ini? Keluhan dan masukan Anda sangat berarti bagi kami.</p>
                <form action="{{ route('projects.feedback', $project->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Rating</label>
                        <select name="rating" required class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm">
                            <option value="">Pilih Rating...</option>
                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                            <option value="4">⭐⭐⭐⭐ (Puas)</option>
                            <option value="3">⭐⭐⭐ (Cukup)</option>
                            <option value="2">⭐⭐ (Kurang)</option>
                            <option value="1">⭐ (Sangat Kurang)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Keluhan / Masukan</label>
                        <textarea name="keluhan_masukan" rows="3" required class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" placeholder="Tuliskan pengalaman atau kendala yang dialami..."></textarea>
                    </div>
                    <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-full hover:scale-[1.02] transition-all">Simpan Penilaian</button>
                </form>
            </div>
            @elseif($project->rating || $project->keluhan_masukan)
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Penilaian Proyek</h3>
                @if($project->rating)
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-2xl font-bold text-on-surface">{{ $project->rating }} / 5</span>
                    <span class="text-amber-400 text-xl">{{ str_repeat('★', $project->rating) }}{{ str_repeat('☆', 5 - $project->rating) }}</span>
                </div>
                @endif
                @if($project->keluhan_masukan)
                <div>
                    <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">Masukan</p>
                    <p class="text-on-surface-variant italic">"{{ $project->keluhan_masukan }}"</p>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Client Info -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pelanggan</h4>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-primary-container flex items-center justify-center text-lg font-bold text-on-primary-container">
                            {{ $project->customer->initials }}
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">{{ $project->customer->nama }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $project->customer->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        @if($project->customer->telepon)
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                            <span class="text-on-surface font-medium">{{ $project->customer->telepon }}</span>
                        </div>
                        @endif
                        @if($project->customer->kota)
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                            <span class="text-on-surface font-medium">{{ $project->customer->kota }}{{ $project->customer->provinsi ? ', ' . $project->customer->provinsi : '' }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Info -->
                @if($project->order)
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pembayaran</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">No Faktur</span>
                            <span class="text-sm font-bold text-on-surface">#{{ $project->order->nomor_faktur }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Metode</span>
                            <span class="text-sm font-bold text-on-surface">
                                @php
                                    $metodeLbl = match($project->order->metode_pembayaran) {
                                        'transfer_bank' => 'Transfer Bank',
                                        'kartu_kredit' => 'Kartu Kredit',
                                        'dp_pelunasan' => 'DP + Pelunasan',
                                        default => '-',
                                    };
                                @endphp
                                {{ $metodeLbl }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Status</span>
                            @php
                                $bayarLbl = match($project->order->status_pembayaran) {
                                    'belum_bayar' => ['Belum Bayar', 'text-error'],
                                    'dp' => ['DP Dibayar', 'text-amber-600'],
                                    'lunas' => ['Lunas', 'text-emerald-600'],
                                    default => ['-', 'text-on-surface'],
                                };
                            @endphp
                            <span class="text-sm font-bold {{ $bayarLbl[1] }}">{{ $bayarLbl[0] }}</span>
                        </div>
                        @php
                            $totalBayar = $project->order->payments->sum('jumlah');
                            $sisaBayar = $project->order->total - $totalBayar;
                            $pctBayar = $project->order->total > 0 ? round(($totalBayar / $project->order->total) * 100) : 0;
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Dibayar</span>
                            <span class="text-sm font-bold text-primary">Rp {{ number_format($totalBayar, 0, ',', '.') }} ({{ $pctBayar }}%)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Sisa</span>
                            <span class="text-sm font-bold {{ $sisaBayar > 0 ? 'text-error' : 'text-emerald-600' }}">Rp {{ number_format(max($sisaBayar, 0), 0, ',', '.') }}</span>
                        </div>
                        <div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $pctBayar }}%"></div>
                        </div>
                        <p class="text-[10px] text-outline text-center">{{ $pctBayar }}% dibayar</p>
                    </div>
                </div>
                @endif

                <!-- Delivery Info -->
                @if($project->order)
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pengiriman</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Prioritas</span>
                            <span class="text-sm font-bold text-on-surface">{{ ucfirst($project->order->prioritas) }}</span>
                        </div>
                        @if($project->order->estimasi_pengiriman)
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Estimasi</span>
                            <span class="text-sm font-bold text-on-surface">{{ $project->order->estimasi_pengiriman->translatedFormat('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->order->alamat_pengiriman)
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Alamat</span>
                            <span class="text-sm font-bold text-on-surface text-right max-w-[160px]">{{ $project->order->alamat_pengiriman }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Notes -->
                @if($project->order && $project->order->catatan)
                <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">note</span>
                        Instruksi Khusus
                    </h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">{{ $project->order->catatan }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
