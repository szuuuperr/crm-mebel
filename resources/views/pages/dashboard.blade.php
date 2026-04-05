@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Dashboard Canvas -->
<div class="pt-32 px-10 pb-20">
    <!-- Header Title -->
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight">Dashboard</h2>
            <p class="text-on-surface-variant font-medium mt-1">Kamis, 24 Oktober 2024</p>
        </div>
        <div class="flex gap-3">
            <button onclick="openModal('modal-export')" class="px-6 py-2 bg-secondary-container text-on-secondary-container rounded-full text-sm font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">download</span>
                Export Laporan
            </button>
        </div>
    </div>

    <!-- Bento Grid Metrics -->
    <div class="grid grid-cols-12 gap-6 mb-10">
        <!-- Sales Overview Chart Widget -->
        <div class="col-span-8 bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-primary">Kinerja Penjualan</h3>
                <div class="flex gap-2 text-xs font-bold text-outline uppercase tracking-tighter">
                    <span class="px-3 py-1 bg-surface-container rounded-full">Mingguan</span>
                    <span class="px-3 py-1 text-primary border border-primary rounded-full">Bulanan</span>
                </div>
            </div>
            <div class="h-64 flex items-end gap-4 px-2">
                @php
                    $chartData = [
                        ['label' => 'MON', 'height' => '40%', 'value' => '12k'],
                        ['label' => 'TUE', 'height' => '65%', 'value' => '18k'],
                        ['label' => 'WED', 'height' => '90%', 'value' => '24k', 'highlight' => true],
                        ['label' => 'THU', 'height' => '55%', 'value' => '15k'],
                        ['label' => 'FRI', 'height' => '75%', 'value' => '20k'],
                        ['label' => 'SAT', 'height' => '35%', 'value' => '10k'],
                    ];
                @endphp
                @foreach($chartData as $bar)
                <div class="flex-1 group relative">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-primary text-on-primary text-[10px] rounded opacity-0 group-hover:opacity-100 transition-opacity">{{ $bar['value'] }}</div>
                    <div class="w-full bg-surface-container-high rounded-t-xl overflow-hidden transition-all hover:h-[{{ intval($bar['height']) + 5 }}%]" style="height: {{ $bar['height'] }}">
                        <div class="w-full h-full bg-gradient-to-t {{ isset($bar['highlight']) ? 'from-primary to-primary-container' : 'from-primary/80 to-primary-container/40' }}"></div>
                    </div>
                    <p class="text-[10px] text-center mt-3 font-bold {{ isset($bar['highlight']) ? 'text-primary' : 'text-outline' }}">{{ $bar['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Secondary Summary Widgets -->
        <div class="col-span-4 flex flex-col gap-6">
            <div class="bg-primary text-on-primary rounded-xl p-6 flex flex-col justify-between h-1/2 shadow-lg relative overflow-hidden">
                <div class="z-10">
                    <p class="text-primary-fixed-dim text-sm font-medium mb-1">Total Pendapatan</p>
                    <h4 class="text-3xl font-extrabold tracking-tight">Rp 124.590.000</h4>
                </div>
                <div class="flex items-center gap-2 z-10">
                    <span class="material-symbols-outlined text-green-400 text-sm">trending_up</span>
                    <span class="text-xs font-bold text-primary-fixed">+12.5% dari bulan lalu</span>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">account_balance_wallet</span>
                </div>
            </div>
            <div class="bg-secondary-container rounded-xl p-6 flex flex-col justify-between h-1/2 shadow-sm relative overflow-hidden">
                <div class="z-10">
                    <p class="text-on-secondary-container/60 text-sm font-medium mb-1">Proyek Aktif</p>
                    <h4 class="text-3xl font-extrabold text-on-secondary-container tracking-tight">34 Pesanan</h4>
                </div>
                <div class="flex items-center gap-2 z-10">
                    <span class="material-symbols-outlined text-on-secondary-container text-sm">pending_actions</span>
                    <span class="text-xs font-bold text-on-secondary-container">9 mendekati deadline</span>
                </div>
                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <span class="material-symbols-outlined text-[100px]">carpenter</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Grid -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Ongoing Projects -->
        <div class="col-span-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-primary">Proyek Berjalan</h3>
                <a class="text-sm font-bold text-primary hover:underline" href="#">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @php
                    $projects = [
                        [
                            'name' => 'Custom Walnut Dining Table',
                            'client' => 'Elizabeth Swan',
                            'order' => '#8821',
                            'status' => 'VARNISHING',
                            'statusClass' => 'bg-primary/10 text-primary',
                            'progress' => 'w-3/4',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBG7QyHUGiNALUJffjCdcNoPJMxyXq3icljT_Lrd6O0YiJixiBBMeYEh-X3DgfyZaDceQy1bXRpqksgvLv5KeG18YSg7hcs-HaigiLGo13TKHQHIr-7aof1N2lv5RcQSQ17EEaUIdLgwr2qlFSNUIY-DxjQnK17ASwCrzrW3XTSWLuEvkRmiSqq5xmYis8r-T-t1DRyWrwbaiNiBAVTAPH8HaiMFHNfLhKNOgJ-z9laZ2h3a0It5W5dxKGKv8SL8zBGmtAq3ecEnucC',
                        ],
                        [
                            'name' => 'Scandinavian Oak Chair Set',
                            'client' => 'Marcus Aurelius',
                            'order' => '#8824',
                            'status' => 'ASSEMBLY',
                            'statusClass' => 'bg-secondary-container text-on-secondary-container',
                            'progress' => 'w-1/2',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRB-7w255M5K63wx1wYZJmgo2g-eh9VFfDKXhkt1_6LyPQ0hB2_17W9JrkErqJ4ch5pI9vQLCWWDso05gE3zw4MfCJU_FK89ktZcQKJImvcIetRfndhBUlkLuwXSJgj2zwR7nn_5ohc5HRNQ5kemTjp5e70CwxEBtUd9lp5U41lQxJQFjNjPpCoBiqryhsXnWqWYzjM2gl2mdnarYG2jxyfSUM-tlfFGUQ9_65JLPNlwtJ4u8pPwCkoDOMoT__ExuQ1EnlZqH_1R67',
                        ],
                        [
                            'name' => 'Live Edge Floating Shelves',
                            'client' => 'Sarah Jenkins',
                            'order' => '#8829',
                            'status' => 'Sanding',
                            'statusClass' => 'bg-surface-container text-outline',
                            'progress' => 'w-1/4',
                            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCaPhpfV72j4BMFCT7R4Q8BzjgbZoAaXeKITk5TMeRWxS7Nt9UI2lMaPwVSc1f55yAJ06Ap5RSpEznfaaaAyzMW3opG0fEgiewI6dNC4IiPuRwsADS60OfVR2Kmf9OehwUqS10dhZQgVQbwPOf_L5jxnr0odvyxUSdCF-0NKffpe3roGsVQ9LHurcvXsvTGzIcl3W2NbtNJ51m4PsONf-76Z3MZxb77o9kFAR36iFKkX_yB0LJvBapbxpipjsJk83eWm1M-qjv5fQ1V',
                        ],
                    ];
                @endphp

                @foreach($projects as $project)
                <div class="bg-surface-container-low rounded-lg p-6 flex items-center justify-between group hover:bg-surface-container-lowest transition-all duration-300">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-surface-container-high flex-shrink-0">
                            <img alt="{{ $project['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $project['image'] }}"/>
                        </div>
                        <div>
                            <h5 class="font-bold text-primary">{{ $project['name'] }}</h5>
                            <p class="text-sm text-on-surface-variant font-medium">Client: {{ $project['client'] }} • Order {{ $project['order'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-8">
                        <div class="text-right">
                            <p class="text-xs font-bold text-outline mb-1 uppercase tracking-wider">Status</p>
                            <span class="px-4 py-1 {{ $project['statusClass'] }} text-[10px] font-black rounded-full">{{ $project['status'] }}</span>
                        </div>
                        <div class="w-32 h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full {{ $project['progress'] }}"></div>
                        </div>
                        <button class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- New Customers & Materials Swatches -->
        <div class="col-span-4 space-y-6">
            <!-- New Customers Card -->
            <div class="bg-surface-container-high rounded-xl p-8">
                <h3 class="text-xl font-bold text-primary mb-6">Permintaan Terbaru</h3>
                <div class="space-y-6">
                    @php
                        $enquiries = [
                            ['initials' => 'JD', 'name' => 'Jonathan Doe', 'request' => 'Mahogany Armoire', 'bgClass' => 'bg-primary-container text-on-primary-container'],
                            ['initials' => 'MK', 'name' => 'Mina Koda', 'request' => 'Modern Bed Frame', 'bgClass' => 'bg-secondary text-on-secondary'],
                            ['initials' => 'BT', 'name' => 'Brandon T.', 'request' => 'Office Fit-out', 'bgClass' => 'bg-outline-variant text-on-surface'],
                        ];
                    @endphp
                    @foreach($enquiries as $enquiry)
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full {{ $enquiry['bgClass'] }} flex items-center justify-center font-bold text-xs">
                            {{ $enquiry['initials'] }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-primary">{{ $enquiry['name'] }}</p>
                            <p class="text-xs text-on-surface-variant">Request: {{ $enquiry['request'] }}</p>
                        </div>
                        <button class="ml-auto text-primary">
                            <span class="material-symbols-outlined text-xl">mail</span>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button class="w-full mt-8 py-3 border border-primary/20 rounded-full text-xs font-bold text-primary hover:bg-primary/5 transition-colors">
                    Kelola Semua Prospek
                </button>
            </div>

            <!-- Material Stock Level -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Stok Bahan Baku</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-4 h-4 rounded-full bg-[#4a3728]"></div>
                            <span class="text-xs font-bold text-primary">Black Walnut</span>
                        </div>
                        <span class="text-xs font-bold text-error">Stok Menipis (12m)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-4 h-4 rounded-full bg-[#c19a6b]"></div>
                            <span class="text-xs font-bold text-primary">White Oak</span>
                        </div>
                        <span class="text-xs font-bold text-green-600">Stok Aman (140m)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-4 h-4 rounded-full bg-[#96694c]"></div>
                            <span class="text-xs font-bold text-primary">Cherry Wood</span>
                        </div>
                        <span class="text-xs font-bold text-on-secondary-container">Stok Cukup (45m)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('fab')
<a class="fixed bottom-10 right-10 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform z-50 group" href="{{ route('orders.create') }}">
    <span class="material-symbols-outlined text-3xl">add</span>
    <div class="absolute right-20 bg-primary text-on-primary px-4 py-2 rounded-lg text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
        Buat Pesanan
    </div>
</a>
@endsection

@section('modals')
@include('components.modal-export')
@endsection
