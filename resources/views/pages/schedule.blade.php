@extends('layouts.app')

@section('title', 'Jadwal')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Jadwal Bengkel</h2>
            <p class="text-on-surface-variant mt-1">Rencanakan pengiriman, pencapaian, dan pertemuan klien</p>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">today</span> Hari Ini
            </button>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span> Tambah Acara
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <!-- Calendar -->
        <div class="col-span-8">
            <!-- Month Navigation -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-on-surface font-headline">Oktober 2023</h3>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <!-- Day Headers -->
                <div class="grid grid-cols-7 bg-primary">
                    @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)
                    <div class="py-3 text-center text-xs font-bold text-on-primary uppercase tracking-widest">{{ $day }}</div>
                    @endforeach
                </div>
                <!-- Calendar Days -->
                @php
                    $events = [
                        5 => [['title'=>'Pertemuan Klien','color'=>'bg-blue-400']],
                        8 => [['title'=>'Pengiriman Kayu Oak','color'=>'bg-emerald-400']],
                        12 => [['title'=>'Deadline Set Meja Makan','color'=>'bg-primary'],['title'=>'Pengambilan Eleanor','color'=>'bg-amber-400']],
                        15 => [['title'=>'Perawatan Bengkel','color'=>'bg-orange-400']],
                        18 => [['title'=>'Proposal: S. Mitchell','color'=>'bg-purple-400']],
                        20 => [['title'=>'Inspeksi Kualitas','color'=>'bg-blue-400']],
                        24 => [['title'=>'Konsultasi Pesanan Baru','color'=>'bg-primary']],
                        28 => [['title'=>'Pengiriman Teak','color'=>'bg-emerald-400']],
                        30 => [['title'=>'Review Akhir Bulan','color'=>'bg-surface-container-highest text-on-surface']],
                    ];
                    $today = 24;
                    $startDay = 0; // Oct 2023 starts on Sunday
                    $daysInMonth = 31;
                    $prevDays = [25,26,27,28,29,30]; // Sept fill
                @endphp

                @for($week = 0; $week < 5; $week++)
                <div class="grid grid-cols-7 divide-x divide-outline-variant/10 {{ $week < 4 ? 'border-b border-outline-variant/10' : '' }}">
                    @for($d = 0; $d < 7; $d++)
                    @php
                        $cellNum = $week * 7 + $d + 1 - $startDay;
                        $isOtherMonth = $cellNum < 1 || $cellNum > $daysInMonth;
                        $displayDay = $isOtherMonth ? ($cellNum < 1 ? $prevDays[count($prevDays)+$cellNum-1] ?? '' : $cellNum - $daysInMonth) : $cellNum;
                        $isToday = !$isOtherMonth && $cellNum == $today;
                        $dayEvents = !$isOtherMonth ? ($events[$cellNum] ?? []) : [];
                    @endphp
                    <div class="min-h-[100px] p-2 {{ $isOtherMonth ? 'bg-surface-container-low/30' : 'hover:bg-surface-container-low/50' }} transition-colors">
                        <div class="flex justify-between items-start mb-1">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full text-xs font-bold {{ $isToday ? 'bg-primary text-on-primary shadow-md' : ($isOtherMonth ? 'text-outline-variant/40' : 'text-on-surface') }}">{{ $displayDay }}</span>
                        </div>
                        <div class="space-y-1">
                            @foreach($dayEvents as $ev)
                            <div class="px-2 py-1 {{ $ev['color'] }} text-white rounded text-[9px] font-bold truncate cursor-pointer hover:opacity-80 transition-opacity">{{ $ev['title'] }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endfor
                </div>
                @endfor
            </div>

            <!-- Color Legend -->
            <div class="flex items-center gap-6 mt-4">
                @php $legends = [
                    ['color'=>'bg-primary','label'=>'Deadline'],
                    ['color'=>'bg-emerald-400','label'=>'Pengiriman'],
                    ['color'=>'bg-blue-400','label'=>'Pertemuan'],
                    ['color'=>'bg-amber-400','label'=>'Pengambilan'],
                    ['color'=>'bg-purple-400','label'=>'Proposal'],
                    ['color'=>'bg-orange-400','label'=>'Perawatan'],
                ]; @endphp
                @foreach($legends as $l)
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full {{ $l['color'] }}"></div>
                    <span class="text-[10px] font-bold text-outline uppercase tracking-wider">{{ $l['label'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar: Upcoming Events -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-6">Acara Mendatang</h4>
                    <div class="space-y-4">
                        @php $upcoming = [
                            ['title'=>'Konsultasi Pesanan Baru','date'=>'24 Okt','time'=>'10:00','icon'=>'groups','color'=>'bg-primary/10 text-primary','client'=>'Eleanor Shellstrop'],
                            ['title'=>'Kedatangan Pengiriman Teak','date'=>'28 Okt','time'=>'14:00','icon'=>'local_shipping','color'=>'bg-emerald-100 text-emerald-700','client'=>'Pemasok: WoodCraft Co.'],
                            ['title'=>'Review Akhir Bulan','date'=>'30 Okt','time'=>'16:00','icon'=>'assessment','color'=>'bg-surface-container-high text-on-surface-variant','client'=>'Internal'],
                            ['title'=>'QC Kayu Walnut','date'=>'2 Nov','time'=>'09:00','icon'=>'verified','color'=>'bg-blue-100 text-blue-700','client'=>'Julian Varkas'],
                        ]; @endphp
                        @foreach($upcoming as $u)
                        <div class="flex items-start gap-3 p-4 bg-surface-container-low rounded-lg hover:bg-surface-container-low/80 transition-colors">
                            <div class="w-10 h-10 rounded-full {{ $u['color'] }} flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-sm">{{ $u['icon'] }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-on-surface truncate">{{ $u['title'] }}</p>
                                <p class="text-[10px] text-on-surface-variant">{{ $u['client'] }}</p>
                                <p class="text-[10px] text-primary font-bold mt-1">{{ $u['date'] }} · {{ $u['time'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-8xl opacity-10">calendar_month</span>
                    <div class="relative z-10">
                        <p class="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">Bulan Ini</p>
                        <p class="text-3xl font-black font-headline mb-4">9 Acara</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between"><span class="opacity-70">Pengiriman</span><span class="font-bold">3</span></div>
                            <div class="flex justify-between"><span class="opacity-70">Pertemuan</span><span class="font-bold">2</span></div>
                            <div class="flex justify-between"><span class="opacity-70">Deadline</span><span class="font-bold">2</span></div>
                            <div class="flex justify-between"><span class="opacity-70">Lainnya</span><span class="font-bold">2</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
