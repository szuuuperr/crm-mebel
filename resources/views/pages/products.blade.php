@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
<!-- Content Area -->
<div class="pt-28 pb-12 px-10">
    <!-- Page Header Section -->
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-4xl font-black font-headline text-primary tracking-tight mb-2">Koleksi Furniture</h2>
            <p class="text-on-surface-variant max-w-md">Kelola kreasi kerajinan Anda, lacak stok material, dan perbarui inventaris showroom digital Anda.</p>
        </div>
        <a class="group flex items-center gap-3 bg-primary text-on-primary px-8 py-4 rounded-full font-bold shadow-xl hover:scale-105 transition-all" href="{{ route('products.create') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
            <span>Tambah Furniture Baru</span>
        </a>
    </div>

    <!-- Filters Bar -->
    <div class="flex items-center gap-4 mb-10 overflow-x-auto pb-2 no-scrollbar">
        <button class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-medium whitespace-nowrap">Semua Koleksi</button>
        <button class="bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 px-6 py-2.5 rounded-full font-medium whitespace-nowrap hover:bg-primary/5 transition-colors">Aged Oak</button>
        <button class="bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 px-6 py-2.5 rounded-full font-medium whitespace-nowrap hover:bg-primary/5 transition-colors">Premium Teak</button>
        <button class="bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 px-6 py-2.5 rounded-full font-medium whitespace-nowrap hover:bg-primary/5 transition-colors">Mahogany Noir</button>
        <button class="bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 px-6 py-2.5 rounded-full font-medium whitespace-nowrap hover:bg-primary/5 transition-colors">Walnut Grain</button>
        <button class="bg-surface-container-lowest text-on-surface-variant border-2 border-outline-variant/20 px-6 py-2.5 rounded-full font-medium whitespace-nowrap hover:bg-primary/5 transition-colors">Nordic Pine</button>
        <div class="ml-auto flex items-center gap-2">
            <span class="text-sm font-semibold text-outline">View:</span>
            <button class="p-2 rounded-lg bg-surface-container-high text-primary"><span class="material-symbols-outlined">grid_view</span></button>
            <button class="p-2 rounded-lg text-outline hover:bg-surface-container-low"><span class="material-symbols-outlined">list</span></button>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            $products = [
                [
                    'name' => 'The Sculptural Armchair', 'desc' => 'Mid-century modern aesthetic', 'price' => '$1,240',
                    'material' => 'Walnut', 'materialColor' => '#5D4037', 'feature' => 'Linen', 'featureIcon' => 'texture',
                    'stock' => '12 Units', 'stockClass' => 'text-primary', 'badge' => 'New Arrival',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDtYYLrcOQo6TP8T3P9MUajI9LAOO912pWXVG3GhDgeiPjzdpDniXpifVF6NQOxv5p6w2vCA8Zu433DpijsTV_cflDd3bha5iaD-wiJiwBhvB0QrKedhjJ65HzIUuizZCwdeFvZ0SnjW9xLheSspFK5GC1BTIGnDVzr1Jtrxo3Kn-66J56webKXb7CCb4fHkN0_1EZmSWsL4wAHzDGyRKE6Vsic4TAccCV5i4ktiCslDPZi846_8ln6I-n8ItPAW6oWYS7r6EJsraFD',
                ],
                [
                    'name' => 'Heritage Oak Table', 'desc' => '8-Seater solid wood slab', 'price' => '$3,800',
                    'material' => 'Natural Oak', 'materialColor' => '#B1937E', 'feature' => 'Custom Sizes', 'featureIcon' => 'square_foot',
                    'stock' => '2 Units', 'stockClass' => 'text-error', 'stockLabel' => 'Low Stock:',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A',
                ],
                [
                    'name' => 'Linear Teak Sideboard', 'desc' => 'Sleek storage solution', 'price' => '$2,150',
                    'material' => 'Reclaimed Teak', 'materialColor' => '#8E593C', 'feature' => '3 Compartments', 'featureIcon' => 'inventory_2',
                    'stock' => '8 Units', 'stockClass' => 'text-primary',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCOQojRGH3OYUwn0rhJlAf_LX2bdNw48FdOgiR-TbfZpcFbnhwhViI65af0ISxKRKcqN2CucleKlarhrECbwCqyQBI1fd3pnPwrNh3Eux2YAHYVuM7-xInep6YeJ_QWYZG25OFtdy4LOZ0pNsQfiuUyVcaR7L2QQvDn58vt1IjNy8JhNnqJ9fHXij-M7JV0GT19biEf8ogaTI8f5zII-HjMTXnKEJdpHHF6vTAM9UeX3uNKnVxU6Qo1X2cPlq0ULGNz6X3u8uAYeNG4',
                ],
                [
                    'name' => 'Royal Mahogany Cabinet', 'desc' => 'Hand-carved detailing', 'price' => '$5,400',
                    'material' => 'Mahogany', 'materialColor' => '#4E2A1E', 'feature' => 'Signature Series', 'featureIcon' => 'workspace_premium',
                    'stock' => '5 Units', 'stockClass' => 'text-primary',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKFebMRq9Mv8G6uRYHnx15xjuCdNfW7_yxq7HKhHtEe40Uf2ryVsz35paDo4GIEZh5hkKlHpOPcR3_zEFEspWsUGIgGa7U9H9WDOjYDBSFXmVER74oUmdcXYqum1pzjIF8xlEMefEia7I6y0CMfKiD5PS85ew1KImhmYucok750UkVGc86FvMzpaAllUkV3jk6KQzHrjq_sh-StyfDBW3j2APDJn2n17R5qZkUuP7N3Bsjw4iHOgNMCt4LxrLak-H_XUXL05kkWUcY',
                ],
                [
                    'name' => 'Nordic Lounge Sofa', 'desc' => 'Sustainable pine framework', 'price' => '$2,900',
                    'material' => 'Pine', 'materialColor' => '#E5D3B3', 'feature' => 'Eco-Friendly', 'featureIcon' => 'eco',
                    'stock' => 'Pre-Order', 'stockClass' => 'text-on-tertiary-container', 'isPreorder' => true,
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCDAn6qW9CQUZtnAF8dyRXpfL187sfG0SaGj7D8TKkEQ-Maa8C-TSpTMUR5cBogvX1btpXyCMM8G8WkVaEPLetUwDJYGPmm7Oot7jVCOZhxDZ45fT8hKbEtSmgdnOlkS0QFUhdFa8iXT2CLEX21W9_ad__NT87J6TCpgXjsjkcLfbYB20aaXPUqrizYB6Tc9pqiCc2OC5lad9hj3qz_5Kkyyh4tOT2vh1fvyJeKR1ac8agWHRcfO897w99hhP2YrUxgRA4Cp7oBOIBl',
                ],
            ];
        @endphp

        @foreach($products as $product)
        <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-outline-variant/10">
            <div class="relative h-72 overflow-hidden">
                <img alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $product['image'] }}"/>
                @if(isset($product['badge']))
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter text-primary">{{ $product['badge'] }}</span>
                </div>
                @endif
                <div class="absolute bottom-4 right-4 glass-overlay px-4 py-2 rounded-lg flex items-center gap-2">
                    @if(isset($product['isPreorder']))
                        <span class="text-xs font-bold {{ $product['stockClass'] }}">{{ $product['stock'] }}</span>
                    @else
                        <span class="text-xs font-bold {{ $product['stockClass'] }}">{{ $product['stockLabel'] ?? 'Stock:' }}</span>
                        <span class="text-xs font-black {{ $product['stockClass'] }}">{{ $product['stock'] }}</span>
                    @endif
                </div>
            </div>
            <div class="p-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold font-headline text-on-surface group-hover:text-primary transition-colors">{{ $product['name'] }}</h3>
                        <p class="text-sm text-on-surface-variant">{{ $product['desc'] }}</p>
                    </div>
                    <span class="text-2xl font-black text-primary font-headline">{{ $product['price'] }}</span>
                </div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center gap-1 bg-surface-container-low px-2 py-1 rounded-md">
                        <div class="w-3 h-3 rounded-full" style="background-color: {{ $product['materialColor'] }}"></div>
                        <span class="text-[11px] font-bold text-on-surface-variant">{{ $product['material'] }}</span>
                    </div>
                    <div class="flex items-center gap-1 bg-surface-container-low px-2 py-1 rounded-md">
                        <span class="material-symbols-outlined text-[14px]">{{ $product['featureIcon'] }}</span>
                        <span class="text-[11px] font-bold text-on-surface-variant">{{ $product['feature'] }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="flex-1 bg-primary text-on-primary py-3 rounded-full text-sm font-bold hover:bg-primary-container transition-colors">Lihat Detail</button>
                    <button class="w-12 h-12 flex items-center justify-center border-2 border-outline-variant/30 rounded-full text-outline hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Custom Commission Card -->
        <div class="group bg-primary-container text-on-primary-container rounded-xl overflow-hidden shadow-xl flex flex-col justify-between p-8 border border-primary/20">
            <div class="space-y-4">
                <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center text-on-primary mb-6">
                    <span class="material-symbols-outlined text-3xl">auto_awesome</span>
                </div>
                <h3 class="text-2xl font-black font-headline leading-tight">Permintaan Pesanan Khusus</h3>
                <p class="text-on-primary-container/80 text-sm">Butuh furniture unik yang tidak ada di katalog kami? Mulai proyek woodworking khusus baru secara langsung.</p>
            </div>
            <div class="mt-12 space-y-4">
                <div class="flex items-center -space-x-3 mb-6">
                    <img class="w-10 h-10 rounded-full border-2 border-primary-container object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAPVei5IQ-g74tQxY19VjsuZtH4RmLV5yiYldX2wRzk-pzC7hUSfeojB0bHr1LAzjmCPB9ckg0J5z2q14ycJwa6ctx7gjINHD0LcTphfM748W05rd8-e4ZKDNQCnCPLJGH_DaSvO5Pd17IZ0noL5YaBK-EgfgbX1ENdTDSwiZ9WYmefUntaUfMi_ZV8-a3YZ5_DseJPbNcDouM9VQ2CRw6yWeaPRnM3Y1TLp5o3wkYvZ8HQD0HKHG_rrRamwRHoHE5kq9ovm-Y6R2zB"/>
                    <img class="w-10 h-10 rounded-full border-2 border-primary-container object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOy8TkxGqOQZKJFUs60_b3SaMCE9lCP5g9Ih596lx3Q9pX7i0Y9sHLXomu7MfYAlG7FCW4mV897gIlutr2DqMUoNbHxiJud0Splgvb6JOFmLEQv1U5aUXXm2qR9jg_V7pRueyhgzZBg3mP4lSyWNj0Grc0sl48o2PgCVfGyJhIAZ4Am2vI9xfCbhEx-tUSqHdfNNPd8lEUjyv-S0ZjdCvREPFCFNrwBfMygi-6cRYdUbevRd8zuQLD0G-lnUR_QCWSqDOSlXlwqpZa"/>
                    <img class="w-10 h-10 rounded-full border-2 border-primary-container object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCoxAuuJiyVTpuy9_6d5UH7ELjX_qfg1eNLOCYYq4J3XjIBNnU-o3ojBVNa88T1OUMThyVHm-MKct6zjh_lqTMTH6GhciK9suxH0fwxMrZfoSpZ2D4tb3CPBVRIlrGLe0-P24NaTPBPraVs8p1tKTtymZZMQgLvHA24Sfg2EQwjNhdf8CFZM3KoheZ8tVhrKYWWlkc8TmMbUs0z3QPhu-vo3dKm7QHBQvhYyN7AMfuVQvIhxR92RVIp0jMh269z3c47qmK92uzvijE9"/>
                    <div class="w-10 h-10 rounded-full border-2 border-primary-container bg-primary flex items-center justify-center text-[10px] font-black text-on-primary">+14</div>
                </div>
                <button class="w-full bg-on-primary-container text-primary py-4 rounded-full font-black text-sm hover:bg-white transition-colors">Mulai Pembuat Pesanan Khusus</button>
            </div>
        </div>
    </div>

    <!-- Inventory Insights Section -->
    <div class="mt-16 grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3 bg-surface-container-low rounded-xl p-8 flex flex-col md:flex-row gap-8 items-center">
            <div class="flex-1">
                <h4 class="text-xl font-bold font-headline text-primary mb-2">Laporan Kesehatan Material</h4>
                <p class="text-sm text-on-surface-variant mb-6">Tingkat kayu mentah saat ini untuk siklus produksi aktif.</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $materials = [
                            ['name' => 'Oak', 'pct' => 84, 'color' => 'bg-primary'],
                            ['name' => 'Teak', 'pct' => 32, 'color' => 'bg-error'],
                            ['name' => 'Walnut', 'pct' => 65, 'color' => 'bg-primary'],
                            ['name' => 'Mahogany', 'pct' => 91, 'color' => 'bg-primary'],
                        ];
                    @endphp
                    @foreach($materials as $mat)
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-black text-primary uppercase"><span>{{ $mat['name'] }}</span><span>{{ $mat['pct'] }}%</span></div>
                        <div class="h-1.5 w-full bg-outline-variant/30 rounded-full overflow-hidden">
                            <div class="h-full {{ $mat['color'] }}" style="width: {{ $mat['pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full md:w-px h-px md:h-24 bg-outline-variant/30"></div>
            <div class="text-center px-4">
                <p class="text-3xl font-black text-primary font-headline">742</p>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mt-1">Total SKU's</p>
            </div>
        </div>
        <div class="bg-surface-container-high rounded-xl p-8 flex flex-col justify-center text-center group cursor-pointer hover:bg-primary hover:text-on-primary transition-all duration-300">
            <span class="material-symbols-outlined text-4xl mb-3 text-primary group-hover:text-on-primary transition-colors">analytics</span>
            <h4 class="font-bold font-headline mb-1">Peringatan Stok</h4>
            <p class="text-xs text-on-surface-variant group-hover:text-on-primary/80 transition-colors">4 Items memerlukan pemesanan ulang segera</p>
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
