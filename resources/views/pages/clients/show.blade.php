@extends('layouts.app')

@section('title', 'Detail Pelanggan - ' . $customer->nama)

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">{{ $customer->nama }}</span>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-400 text-white rounded-lg font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-12 gap-10">
        <!-- Main Content -->
        <div class="col-span-8 space-y-8">
            <!-- Client Header Card -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="h-36 bg-primary relative">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
                </div>
                <div class="px-8 pb-8 -mt-14">
                    <div class="flex items-end gap-6 ">
                        <div class="w-28 h-28 rounded-xl ring-4 ring-surface-container-lowest overflow-hidden shadow-lg bg-primary-container flex items-center justify-center text-primary text-4xl font-black relative z-20">
                            {{ $customer->initials }}
                        </div>
                        <div class="flex-1 pt-16">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h2 class="text-3xl font-extrabold text-primary font-headline">{{ $customer->nama }}</h2>
                                        @if($customer->status_loyalitas === 'vip')
                                        <span class="bg-primary/10 text-primary p-1.5 rounded-full"><span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span></span>
                                        @endif
                                        <span class="px-3 py-1 {{ $customer->status_loyalitas === 'vip' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface' }} text-[10px] font-bold uppercase rounded-full">
                                            @if($customer->status_loyalitas === 'vip') Elite @else {{ ucfirst($customer->status_loyalitas) }} @endif
                                        </span>
                                    </div>
                                    <p class="text-on-surface-variant font-medium mt-1">
                                        {{ $customer->jabatan ? $customer->jabatan . ', ' : '' }}{{ $customer->perusahaan ?: 'Individual' }}
                                    </p>
                                </div>
                                <a class="px-6 py-2.5 bg-primary text-on-primary font-bold rounded-full text-sm hover:scale-[1.02] transition-all flex items-center gap-2" href="{{ route('clients.edit', $customer->id) }}">
                                    <span class="material-symbols-outlined text-sm">edit</span> Ubah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-primary text-on-primary rounded-xl p-6 relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10">payments</span>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">Nilai Seumur Hidup</p>
                    <p class="text-3xl font-black font-headline">Rp {{ number_format($lifetimeValue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-secondary-container text-on-secondary-container rounded-xl p-6 relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10">shopping_bag</span>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">Total Pesanan</p>
                    <p class="text-3xl font-black font-headline">{{ $customer->orders->count() }}</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10 text-outline-variant/20">calendar_today</span>
                    <p class="text-xs font-bold uppercase tracking-widest text-outline mb-1">Pelanggan Sejak</p>
                    <p class="text-3xl font-black font-headline text-primary">{{ $customer->created_at->translatedFormat('M Y') }}</p>
                </div>
            </div>

            <!-- Acquisition History -->
            @if($customer->orders->count() > 0)
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Riwayat Pembelian</h3>
                <div class="space-y-4">
                    @foreach($customer->orders->sortByDesc('tanggal_pesanan') as $order)
                    <a href="{{ route('sales.show', $order->id) }}" class="flex items-center gap-6 p-5 bg-surface-container-low rounded-xl hover:bg-surface-container-low/80 transition-colors">
                        <div class="flex-1">
                            <p class="font-bold text-on-surface">{{ $order->items->first()->product->nama_produk ?? 'Pesanan #' . $order->nomor_faktur }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->items->count() }} item · {{ $order->tanggal_pesanan->translatedFormat('d M Y') }}</p>
                        </div>
                        <span class="text-lg font-black text-primary font-headline">{{ $order->total_format }}</span>
                        @php
                            $sClass = match($order->status) {
                                'selesai' => 'bg-emerald-100 text-emerald-800',
                                'dalam_produksi' => 'bg-amber-100 text-amber-800',
                                'dikirim' => 'bg-blue-100 text-blue-800',
                                'dibatalkan' => 'bg-red-100 text-red-800',
                                default => 'bg-stone-100 text-stone-800',
                            };
                        @endphp
                        <span class="px-3 py-1 {{ $sClass }} text-[10px] font-bold uppercase rounded-full">{{ $order->status_label }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Active Projects -->
            @if($customer->projects && $customer->projects->count() > 0)
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Proyek Aktif</h3>
                @foreach($customer->projects as $project)
                <div class="p-5 bg-surface-container-low rounded-xl mb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="font-bold text-on-surface">{{ $project->nama }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $project->deskripsi }}</p>
                        </div>
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase rounded-full">{{ $project->status }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Kontak</h4>
                    <div class="space-y-4">
                        @if($customer->email)
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">mail</span><span class="text-sm font-medium text-on-surface">{{ $customer->email }}</span></div>
                        @else
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-outline text-[18px]">mail</span><span class="text-sm italic text-outline">Tidak ada email</span></div>
                        @endif
                        
                        @if($customer->telepon)
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">call</span><span class="text-sm font-medium text-on-surface">{{ $customer->telepon }}</span></div>
                        @else
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-outline text-[18px]">call</span><span class="text-sm italic text-outline">Tidak ada nomor handphone</span></div>
                        @endif

                        @if($customer->kota || $customer->provinsi || $customer->alamat)
                        <div class="flex items-center gap-3 items-start">
                            <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                            <div class="text-sm font-medium text-on-surface">
                                @if($customer->kota) {{ $customer->kota }} @if($customer->provinsi), {{ $customer->provinsi }}@endif <br> @endif
                                <span class="text-xs text-on-surface-variant">{{ $customer->alamat }}</span>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
                
                @if($customer->catatan)
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Catatan Internal</h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $customer->catatan }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
