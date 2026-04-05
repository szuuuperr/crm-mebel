@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('products') }}">
            <span class="material-symbols-outlined text-sm align-middle mr-1">arrow_back</span>
            Koleksi
        </a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Meja Makan Walnut Kustom</span>
    </nav>

    <!-- Product Detail Grid -->
    <div class="grid grid-cols-12 gap-10">
        <!-- Image Gallery -->
        <div class="col-span-7">
            <div class="rounded-xl overflow-hidden h-[500px] mb-4 bg-surface-container-high group">
                <img alt="Custom Walnut Dining Table" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A"/>
            </div>
            <div class="grid grid-cols-4 gap-4">
                @php
                    $thumbs = [
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuBG7QyHUGiNALUJffjCdcNoPJMxyXq3icljT_Lrd6O0YiJixiBBMeYEh-X3DgfyZaDceQy1bXRpqksgvLv5KeG18YSg7hcs-HaigiLGo13TKHQHIr-7aof1N2lv5RcQSQ17EEaUIdLgwr2qlFSNUIY-DxjQnK17ASwCrzrW3XTSWLuEvkRmiSqq5xmYis8r-T-t1DRyWrwbaiNiBAVTAPH8HaiMFHNfLhKNOgJ-z9laZ2h3a0It5W5dxKGKv8SL8zBGmtAq3ecEnucC',
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuBRB-7w255M5K63wx1wYZJmgo2g-eh9VFfDKXhkt1_6LyPQ0hB2_17W9JrkErqJ4ch5pI9vQLCWWDso05gE3zw4MfCJU_FK89ktZcQKJImvcIetRfndhBUlkLuwXSJgj2zwR7nn_5ohc5HRNQ5kemTjp5e70CwxEBtUd9lp5U41lQxJQFjNjPpCoBiqryhsXnWqWYzjM2gl2mdnarYG2jxyfSUM-tlfFGUQ9_65JLPNlwtJ4u8pPwCkoDOMoT__ExuQ1EnlZqH_1R67',
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuCaPhpfV72j4BMFCT7R4Q8BzjgbZoAaXeKITk5TMeRWxS7Nt9UI2lMaPwVSc1f55yAJ06Ap5RSpEznfaaaAyzMW3opG0fEgiewI6dNC4IiPuRwsADS60OfVR2Kmf9OehwUqS10dhZQgVQbwPOf_L5jxnr0odvyxUSdCF-0NKffpe3roGsVQ9LHurcvXsvTGzIcl3W2NbtNJ51m4PsONf-76Z3MZxb77o9kFAR36iFKkX_yB0LJvBapbxpipjsJk83eWm1M-qjv5fQ1V',
                        'https://lh3.googleusercontent.com/aida-public/AB6AXuDKFebMRq9Mv8G6uRYHnx15xjuCdNfW7_yxq7HKhHtEe40Uf2ryVsz35paDo4GIEZh5hkKlHpOPcR3_zEFEspWsUGIgGa7U9H9WDOjYDBSFXmVER74oUmdcXYqum1pzjIF8xlEMefEia7I6y0CMfKiD5PS85ew1KImhmYucok750UkVGc86FvMzpaAllUkV3jk6KQzHrjq_sh-StyfDBW3j2APDJn2n17R5qZkUuP7N3Bsjw4iHOgNMCt4LxrLak-H_XUXL05kkWUcY',
                    ];
                @endphp
                @foreach($thumbs as $i => $thumb)
                <div class="rounded-lg overflow-hidden h-24 bg-surface-container-high cursor-pointer {{ $i === 0 ? 'ring-2 ring-primary' : 'hover:ring-2 hover:ring-outline-variant' }} transition-all">
                    <img alt="Product thumbnail" class="w-full h-full object-cover" src="{{ $thumb }}"/>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-span-5 space-y-8">
            <!-- Header -->
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full tracking-wider">Koleksi Signature</span>
                    <span class="px-3 py-1 bg-secondary-container text-on-secondary-container text-[10px] font-black uppercase rounded-full tracking-wider">Tersedia</span>
                </div>
                <h1 class="text-3xl font-extrabold text-primary tracking-tight font-headline mb-2">Meja Makan Walnut Kustom</h1>
                <p class="text-on-surface-variant leading-relaxed">Dibuat tangan dari kayu American Black Walnut premium dengan tepi alami live edge. Setiap potongan unik, menampilkan pola serat alami kayu dan kontur organik.</p>
            </div>

            <!-- Price -->
            <div class="bg-surface-container-low rounded-xl p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">Harga Dasar</p>
                        <p class="text-4xl font-black text-primary font-headline">Rp 4.200.000<span class="text-lg text-on-surface-variant font-medium">,00</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">SKU</p>
                        <p class="text-lg font-bold text-on-surface">WDT-8821</p>
                    </div>
                </div>
            </div>

            <!-- Quick Specs -->
            <div class="grid grid-cols-2 gap-4">
                @php
                    $specs = [
                        ['icon' => 'straighten', 'label' => 'Dimensi', 'value' => '244 × 107 × 76 cm'],
                        ['icon' => 'scale', 'label' => 'Berat', 'value' => '84 kg'],
                        ['icon' => 'palette', 'label' => 'Finishing', 'value' => 'Minyak Alami'],
                        ['icon' => 'group', 'label' => 'Kapasitas', 'value' => '8 Orang'],
                    ];
                @endphp
                @foreach($specs as $spec)
                <div class="bg-surface-container-lowest rounded-lg p-4 border border-outline-variant/10">
                    <span class="material-symbols-outlined text-primary text-sm mb-2 block">{{ $spec['icon'] }}</span>
                    <p class="text-[10px] font-bold text-outline uppercase tracking-widest">{{ $spec['label'] }}</p>
                    <p class="text-sm font-bold text-on-surface mt-1">{{ $spec['value'] }}</p>
                </div>
                @endforeach
            </div>

            <!-- Material Swatch -->
            <div>
                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-3">Pilihan Kayu</h4>
                <div class="flex gap-3">
                    <div class="w-12 h-12 rounded-lg bg-[#4a3728] ring-2 ring-primary ring-offset-2 cursor-pointer" title="Black Walnut"></div>
                    <div class="w-12 h-12 rounded-lg bg-[#c19a6b] hover:ring-2 hover:ring-outline-variant ring-offset-2 cursor-pointer transition-all" title="White Oak"></div>
                    <div class="w-12 h-12 rounded-lg bg-[#96694c] hover:ring-2 hover:ring-outline-variant ring-offset-2 cursor-pointer transition-all" title="Cherry"></div>
                    <div class="w-12 h-12 rounded-lg bg-[#4E2A1E] hover:ring-2 hover:ring-outline-variant ring-offset-2 cursor-pointer transition-all" title="Mahogany"></div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
                <a class="flex-1 bg-primary text-on-primary py-4 rounded-full font-bold text-center flex items-center justify-center gap-2 shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all" href="{{ route('products.edit', 1) }}">
                    <span class="material-symbols-outlined text-xl">edit</span>
                    Ubah Produk
                </a>
                <button class="w-14 h-14 flex items-center justify-center border-2 border-error/30 rounded-full text-error hover:bg-error hover:text-on-error transition-all">
                    <span class="material-symbols-outlined">delete</span>
                </button>
                <button class="w-14 h-14 flex items-center justify-center border-2 border-outline-variant/30 rounded-full text-outline hover:border-primary hover:text-primary transition-all">
                    <span class="material-symbols-outlined">share</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Detail Tabs Section -->
    <div class="mt-16">
        <div class="flex gap-2 border-b border-outline-variant/20 mb-8">
            <button class="px-6 py-3 text-primary font-bold border-b-2 border-primary text-sm">Spesifikasi</button>
            <button class="px-6 py-3 text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Detail Kayu</button>
            <button class="px-6 py-3 text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Ulasan (12)</button>
            <button class="px-6 py-3 text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Riwayat Pesanan</button>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-8 bg-surface-container-lowest rounded-xl p-8">
                <h3 class="text-xl font-bold text-primary mb-6">Spesifikasi Teknis</h3>
                <div class="divide-y divide-outline-variant/20">
                    @php
                        $details = [
                            ['label' => 'Material Utama', 'value' => 'American Black Walnut (Juglans nigra)'],
                            ['label' => 'Sambungan', 'value' => 'Mortise & Tenon Tradisional'],
                            ['label' => 'Ketebalan Atas', 'value' => '6,35 cm (2,5 inci)'],
                            ['label' => 'Gaya Kaki', 'value' => 'Persegi Panjang Meruncing — Penyangga Silang Terintegrasi'],
                            ['label' => 'Jenis Finishing', 'value' => 'Minyak Tung Gosok Tangan — Aman Makanan'],
                            ['label' => 'Profil Tepi', 'value' => 'Live Edge — Kulit Dihilangkan & Diampelas'],
                            ['label' => 'Waktu Produksi', 'value' => '6-8 Minggu (Pesanan Kustom)'],
                            ['label' => 'Garansi', 'value' => 'Seumur Hidup Struktural — 5th Finishing'],
                        ];
                    @endphp
                    @foreach($details as $detail)
                    <div class="flex justify-between py-4">
                        <span class="text-sm font-medium text-on-surface-variant">{{ $detail['label'] }}</span>
                        <span class="text-sm font-bold text-on-surface">{{ $detail['value'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-4 space-y-6">
                <!-- Craftsman Card -->
                <div class="bg-primary text-on-primary rounded-xl p-6 relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 opacity-10">
                        <span class="material-symbols-outlined text-[100px]">handyman</span>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xs font-bold uppercase tracking-widest text-on-primary/60 mb-2">Pengrajin Utama</p>
                        <div class="flex items-center gap-3 mb-4">
                            <img alt="Craftsman" class="w-12 h-12 rounded-full object-cover ring-2 ring-on-primary/20" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZDSDOiwRhwyGRYIJa7mN0i0g8bMKdMesH2MCjvR7uoG2m0eylA2zJ52G6c8Mdj7wpdPXQRLEB_tIXCf-NZW85oYym2hAI2kUzXCZGSIsD1P-vIeRUg8rH5OikpzVjATgA4kMQmck8s5fPaSBZ-3Tgw4kRuR33NsG1iV0HYbFu0I15eY1TTDxOXebh6Y6qpL9xhvsUYeN_mbph7_pUC-N-IPOYcxwegXy3G-_7LO06mijAu1Pqa_N2KTvVRT3reejJwvFLBeRDeP3"/>
                            <div>
                                <p class="font-bold">Julian Thorne</p>
                                <p class="text-xs text-on-primary/60">Tukang Kayu Ahli</p>
                            </div>
                        </div>
                        <p class="text-xs text-on-primary/70 leading-relaxed">Pengalaman 20+ tahun di furniture live-edge. Spesialisasi karya pusaka walnut dan oak.</p>
                    </div>
                </div>

                <!-- Production Status -->
                <div class="bg-surface-container-low rounded-xl p-6">
                    <h4 class="text-sm font-bold text-primary mb-4">Antrian Produksi</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-on-surface-variant">Stok Tersedia</span>
                            <span class="text-sm font-bold text-primary">2 Unit</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-on-surface-variant">Dalam Produksi</span>
                            <span class="text-sm font-bold text-on-surface">3 Unit</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-on-surface-variant">Pesanan Kustom</span>
                            <span class="text-sm font-bold text-on-surface">5 Menunggu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-16">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-bold text-primary">Produk Terkait</h3>
            <a class="text-sm font-bold text-primary hover:underline" href="{{ route('products') }}">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-4 gap-6">
            @php
                $related = [
                    ['name' => 'The Sculptural Armchair', 'price' => '$1,240', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDtYYLrcOQo6TP8T3P9MUajI9LAOO912pWXVG3GhDgeiPjzdpDniXpifVF6NQOxv5p6w2vCA8Zu433DpijsTV_cflDd3bha5iaD-wiJiwBhvB0QrKedhjJ65HzIUuizZCwdeFvZ0SnjW9xLheSspFK5GC1BTIGnDVzr1Jtrxo3Kn-66J56webKXb7CCb4fHkN0_1EZmSWsL4wAHzDGyRKE6Vsic4TAccCV5i4ktiCslDPZi846_8ln6I-n8ItPAW6oWYS7r6EJsraFD'],
                    ['name' => 'Linear Teak Sideboard', 'price' => '$2,150', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCOQojRGH3OYUwn0rhJlAf_LX2bdNw48FdOgiR-TbfZpcFbnhwhViI65af0ISxKRKcqN2CucleKlarhrECbwCqyQBI1fd3pnPwrNh3Eux2YAHYVuM7-xInep6YeJ_QWYZG25OFtdy4LOZ0pNsQfiuUyVcaR7L2QQvDn58vt1IjNy8JhNnqJ9fHXij-M7JV0GT19biEf8ogaTI8f5zII-HjMTXnKEJdpHHF6vTAM9UeX3uNKnVxU6Qo1X2cPlq0ULGNz6X3u8uAYeNG4'],
                    ['name' => 'Royal Mahogany Cabinet', 'price' => '$5,400', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKFebMRq9Mv8G6uRYHnx15xjuCdNfW7_yxq7HKhHtEe40Uf2ryVsz35paDo4GIEZh5hkKlHpOPcR3_zEFEspWsUGIgGa7U9H9WDOjYDBSFXmVER74oUmdcXYqum1pzjIF8xlEMefEia7I6y0CMfKiD5PS85ew1KImhmYucok750UkVGc86FvMzpaAllUkV3jk6KQzHrjq_sh-StyfDBW3j2APDJn2n17R5qZkUuP7N3Bsjw4iHOgNMCt4LxrLak-H_XUXL05kkWUcY'],
                    ['name' => 'Nordic Lounge Sofa', 'price' => '$2,900', 'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCDAn6qW9CQUZtnAF8dyRXpfL187sfG0SaGj7D8TKkEQ-Maa8C-TSpTMUR5cBogvX1btpXyCMM8G8WkVaEPLetUwDJYGPmm7Oot7jVCOZhxDZ45fT8hKbEtSmgdnOlkS0QFUhdFa8iXT2CLEX21W9_ad__NT87J6TCpgXjsjkcLfbYB20aaXPUqrizYB6Tc9pqiCc2OC5lad9hj3qz_5Kkyyh4tOT2vh1fvyJeKR1ac8agWHRcfO897w99hhP2YrUxgRA4Cp7oBOIBl'],
                ];
            @endphp
            @foreach($related as $item)
            <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-outline-variant/10">
                <div class="h-48 overflow-hidden">
                    <img alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $item['image'] }}"/>
                </div>
                <div class="p-5">
                    <h4 class="font-bold text-on-surface group-hover:text-primary transition-colors text-sm">{{ $item['name'] }}</h4>
                    <p class="text-lg font-black text-primary font-headline mt-1">{{ $item['price'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
