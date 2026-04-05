@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Portofolio Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Eleanor Vance</span>
    </nav>

    <div class="grid grid-cols-12 gap-10">
        <!-- Main Content -->
        <div class="col-span-8 space-y-8">
            <!-- Client Header Card -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="h-36 bg-primary relative">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
                </div>
                <div class="px-8 pb-8 -mt-14">
                    <div class="flex items-end gap-6">
                        <div class="w-28 h-28 rounded-xl ring-4 ring-surface-container-lowest overflow-hidden shadow-lg">
                            <img alt="Eleanor Vance" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8BqnZFBl0JSAaA6lYT3nJaQDuS2n0y1gAChCI30SfFvb_wqRk3BxIosw9O7Uk2N8SitQrO5MpbB1Xuuau7fcoA9ZPOVxAOdArrPFtXeCrqJDmwK8JXeGbpfOlyE0kY71GWoYSQMCN-dD80qMSKqE_pa-3nxkwKa9qqh3GTuGXKw86aXTV2sPLkqZ858Dep1OcedeMClqWQTo0wTrLZ4qF5JTEpwMVa-VnscfjXlScpI3jUeK3c9dn0pzScRbTUVPyo7F0lhWPIWUo"/>
                        </div>
                        <div class="flex-1 pt-16">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h2 class="text-3xl font-extrabold text-primary font-headline">Eleanor Vance</h2>
                                        <span class="bg-primary/10 text-primary p-1.5 rounded-full"><span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span></span>
                                        <span class="px-3 py-1 bg-primary text-on-primary text-[10px] font-bold uppercase rounded-full">Lingkaran Elite</span>
                                    </div>
                                    <p class="text-on-surface-variant font-medium mt-1">Head of Design, DesignHouse Studios</p>
                                </div>
                                <a class="px-6 py-2.5 bg-primary text-on-primary font-bold rounded-full text-sm hover:scale-[1.02] transition-all flex items-center gap-2" href="{{ route('clients.edit', 1) }}">
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
                    <p class="text-3xl font-black font-headline">$16,450</p>
                </div>
                <div class="bg-secondary-container text-on-secondary-container rounded-xl p-6 relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10">shopping_bag</span>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">Total Pesanan</p>
                    <p class="text-3xl font-black font-headline">3</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10 text-outline-variant/20">calendar_today</span>
                    <p class="text-xs font-bold uppercase tracking-widest text-outline mb-1">Pelanggan Sejak</p>
                    <p class="text-3xl font-black font-headline text-primary">Jan 2023</p>
                </div>
            </div>

            <!-- Acquisition History -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Riwayat Pembelian</h3>
                @php $orders = [
                    ['item'=>'Set Meja Makan Walnut','desc'=>'Kustom 8-Kursi, Minyak Alami','amount'=>'Rp 12.400.000','date'=>'12 Okt 2023','status'=>'Selesai','statusClass'=>'bg-emerald-100 text-emerald-800','stars'=>5],
                    ['item'=>'Kursi Baca','desc'=>'Walnut, Bantal Linen','amount'=>'Rp 2.850.000','date'=>'15 Mar 2023','status'=>'Selesai','statusClass'=>'bg-emerald-100 text-emerald-800','stars'=>5],
                    ['item'=>'Rak Dinding Kustom','desc'=>'Oak, Set 3, Pasang Dinding','amount'=>'Rp 1.200.000','date'=>'8 Jan 2023','status'=>'Selesai','statusClass'=>'bg-emerald-100 text-emerald-800','stars'=>4],
                ]; @endphp
                <div class="space-y-4">
                    @foreach($orders as $o)
                    <div class="flex items-center gap-6 p-5 bg-surface-container-low rounded-xl hover:bg-surface-container-low/80 transition-colors">
                        <div class="flex-1">
                            <p class="font-bold text-on-surface">{{ $o['item'] }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $o['desc'] }} · {{ $o['date'] }}</p>
                            <div class="flex items-center gap-1 mt-1">
                                @for($i=1;$i<=5;$i++)
                                <span class="material-symbols-outlined text-xs {{ $i <= $o['stars'] ? 'text-amber-400' : 'text-outline-variant/30' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                                @endfor
                            </div>
                        </div>
                        <span class="text-lg font-black text-primary font-headline">{{ $o['amount'] }}</span>
                        <span class="px-3 py-1 {{ $o['statusClass'] }} text-[10px] font-bold uppercase rounded-full">{{ $o['status'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Active Projects -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Proyek Aktif</h3>
                <div class="p-5 bg-surface-container-low rounded-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="font-bold text-on-surface">Live-Edge Coffee Table</p>
                            <p class="text-xs text-on-surface-variant">Walnut Slab, Epoxy River, Hairpin Legs</p>
                        </div>
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold uppercase rounded-full">Dalam Produksi</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: 65%"></div>
                        </div>
                        <span class="text-xs font-bold text-primary">65%</span>
                    </div>
                    <p class="text-xs text-outline mt-2">Perkiraan selesai: 15 Des 2023</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Kontak</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">mail</span><span class="text-sm font-medium text-on-surface">e.vance@designhouse.com</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">call</span><span class="text-sm font-medium text-on-surface">+1 (555) 234-8902</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">location_on</span><span class="text-sm font-medium text-on-surface">Greenwich Village, NY</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">business_center</span><span class="text-sm font-medium text-on-surface">DesignHouse Studios</span></div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Preferensi</h4>
                    <div class="mb-4">
                        <p class="text-xs text-on-surface-variant font-bold mb-2">Kayu Pilihan</p>
                        <div class="flex flex-wrap gap-2">
                            @php $woods=[['n'=>'Walnut','c'=>'#4a3728'],['n'=>'Oak','c'=>'#c19a6b']]; @endphp
                            @foreach($woods as $w)
                            <span class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg">
                                <div class="w-3 h-3 rounded-full" style="background-color:{{ $w['c'] }}"></div>
                                <span class="text-xs font-bold text-on-surface">{{ $w['n'] }}</span>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-on-surface-variant font-bold mb-2">Gaya</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-full">Modern</span>
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-full">Live-Edge</span>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Catatan</h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Lebih suka walnut dan oak. Rentang anggaran Rp 3.000.000-Rp 15.000.000. Tertarik pada produk live-edge. Dirujuk oleh Marcus Sterling.</p>
                </div>
                <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">handshake</span> Sumber Rujukan
                    </h4>
                    <p class="text-sm text-on-surface font-bold">Marcus Sterling</p>
                    <p class="text-xs text-on-surface-variant">Klien firma arsitektur, dirujuk Okt 2022</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
