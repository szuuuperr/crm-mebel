@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('sales') }}">Buku Penjualan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">#INV-8821</span>
    </nav>

    <!-- Order Header -->
    <div class="bg-primary rounded-xl p-10 mb-10 relative overflow-hidden">
        <div class="absolute -right-16 -bottom-16 opacity-10">
            <span class="material-symbols-outlined text-[200px]">receipt_long</span>
        </div>
        <div class="relative z-10 flex justify-between items-start">
            <div class="text-on-primary">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-3xl font-black font-headline">#INV-8821</span>
                    <span class="px-3 py-1 bg-amber-400/20 text-amber-200 text-xs font-bold uppercase tracking-wider rounded-full">Dalam Produksi</span>
                </div>
                <p class="text-on-primary/70 font-medium">Dipesan 24 Okt 2023 · Perkiraan Pengiriman 10 Nov 2023</p>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-3 bg-white/10 hover:bg-white/20 text-on-primary font-bold rounded-full transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">print</span>
                    Cetak Faktur
                </button>
                <button class="px-6 py-3 bg-white text-primary font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Unduh PDF
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <!-- Main Content -->
        <div class="col-span-8 space-y-8">
            <!-- Order Items -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Item Pesanan</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-6 p-5 bg-surface-container-low rounded-xl">
                        <div class="w-24 h-24 rounded-lg overflow-hidden flex-shrink-0">
                            <img alt="Product" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A"/>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-on-surface">Live Edge Walnut Table</h4>
                            <p class="text-sm text-on-surface-variant">Custom 8-Seater, Natural Oil Finish</p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="text-[10px] bg-primary/10 text-primary px-2 py-0.5 rounded-full font-bold uppercase">American Walnut</span>
                                <span class="text-[10px] bg-surface-container-high text-on-surface-variant px-2 py-0.5 rounded-full font-bold">96" × 42" × 30"</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-outline uppercase font-bold tracking-widest">Jml: 1</p>
                            <p class="text-2xl font-black text-primary font-headline mt-1">$4,200.00</p>
                        </div>
                    </div>
                </div>
                <!-- Totals -->
                <div class="mt-6 pt-6 border-t border-outline-variant/20 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Subtotal</span>
                        <span class="font-medium text-on-surface">$4,200.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Pajak (8%)</span>
                        <span class="font-medium text-on-surface">$336.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-on-surface-variant">Pengiriman</span>
                        <span class="font-medium text-on-surface">$150.00</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-outline-variant/20">
                        <span class="text-lg font-bold text-on-surface">Total</span>
                        <span class="text-2xl font-black text-primary font-headline">$4,686.00</span>
                    </div>
                </div>
            </div>

            <!-- Order Status Timeline -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Status Pesanan</h3>
                <div class="flex items-center gap-0 mb-8">
                    @php
                        $stages = [
                            ['label' => 'Dikonfirmasi', 'done' => true],
                            ['label' => 'Dalam Produksi', 'done' => true],
                            ['label' => 'Cek Kualitas', 'done' => false],
                            ['label' => 'Dikirim', 'done' => false],
                            ['label' => 'Diterima', 'done' => false],
                        ];
                    @endphp
                    @foreach($stages as $i => $stage)
                    <div class="flex items-center {{ $i < count($stages) - 1 ? 'flex-1' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $stage['done'] ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-outline' }}">
                                @if($stage['done'])
                                <span class="material-symbols-outlined text-sm">check</span>
                                @else
                                {{ $i + 1 }}
                                @endif
                            </div>
                            <span class="text-[10px] font-bold mt-2 {{ $stage['done'] ? 'text-primary' : 'text-outline' }} whitespace-nowrap">{{ $stage['label'] }}</span>
                        </div>
                        @if($i < count($stages) - 1)
                        <div class="flex-1 h-1 mx-2 rounded-full {{ $stage['done'] ? 'bg-primary' : 'bg-outline-variant/20' }}"></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Client Rating & Review -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Rating & Ulasan Pelanggan</h3>

                <!-- Star Rating -->
                <div class="bg-surface-container-low rounded-xl p-6 mb-6">
                    <div class="flex items-center gap-6">
                        <div class="text-center">
                            <p class="text-5xl font-black text-primary font-headline">4.8</p>
                            <div class="flex items-center gap-1 mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-2xl {{ $i <= 4 ? 'text-amber-400' : 'text-amber-400/40' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                                @endfor
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1">Rating Keseluruhan</p>
                        </div>
                        <div class="flex-1 pl-6 border-l border-outline-variant/20 space-y-2">
                            @php
                                $ratings = [
                                    ['label' => 'Keahlian', 'score' => 5, 'pct' => 100],
                                    ['label' => 'Komunikasi', 'score' => 5, 'pct' => 100],
                                    ['label' => 'Waktu Pengiriman', 'score' => 4, 'pct' => 80],
                                    ['label' => 'Harga Sebanding', 'score' => 5, 'pct' => 100],
                                    ['label' => 'Pengemasan', 'score' => 5, 'pct' => 100],
                                ];
                            @endphp
                            @foreach($ratings as $r)
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-on-surface-variant w-28 text-right">{{ $r['label'] }}</span>
                                <div class="flex-1 h-2 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-400 rounded-full" style="width: {{ $r['pct'] }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-on-surface w-4">{{ $r['score'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Keluhan & Masukan -->
                <div class="space-y-4">
                    <h4 class="text-sm font-bold text-outline uppercase tracking-widest">Keluhan & Masukan</h4>

                    @php
                        $feedback = [
                            [
                                'type' => 'masukan',
                                'icon' => 'lightbulb',
                                'color' => 'bg-secondary-container text-on-secondary-container',
                                'title' => 'Sangat puas dengan kualitas ukiran',
                                'text' => 'Detail ukiran pada kaki meja sangat halus dan rapi. Kayu walnut-nya memiliki grain yang indah. Sangat merekomendasikan!',
                                'date' => 'Oct 28, 2023',
                                'stars' => 5,
                            ],
                            [
                                'type' => 'keluhan',
                                'icon' => 'feedback',
                                'color' => 'bg-error-container/50 text-error',
                                'title' => 'Waktu pengiriman sedikit terlambat',
                                'text' => 'Sempat terlambat 3 hari dari estimasi awal. Namun setelah diterima, kualitas produk sangat baik dan sesuai ekspektasi.',
                                'date' => 'Nov 13, 2023',
                                'stars' => 4,
                            ],
                            [
                                'type' => 'masukan',
                                'icon' => 'thumb_up',
                                'color' => 'bg-primary/10 text-primary',
                                'title' => 'Finishing minyak natural sangat bagus',
                                'text' => 'Warna natural dari tung oil memberikan kesan warm dan premium. Tekstur kayu terasa natural di tangan.',
                                'date' => 'Nov 14, 2023',
                                'stars' => 5,
                            ],
                        ];
                    @endphp

                    @foreach($feedback as $fb)
                    <div class="p-6 bg-surface-container-low rounded-xl">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full {{ $fb['color'] }} flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-sm">{{ $fb['icon'] }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="px-2 py-0.5 {{ $fb['type'] === 'keluhan' ? 'bg-error/10 text-error' : 'bg-primary/10 text-primary' }} text-[10px] font-black uppercase rounded-full">{{ $fb['type'] }}</span>
                                            <h5 class="text-sm font-bold text-on-surface">{{ $fb['title'] }}</h5>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-sm {{ $i <= $fb['stars'] ? 'text-amber-400' : 'text-outline-variant/30' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-xs text-outline">{{ $fb['date'] }}</span>
                                </div>
                                <p class="text-sm text-on-surface-variant leading-relaxed">{{ $fb['text'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Add Feedback -->
                    <div class="border-2 border-dashed border-outline-variant/30 rounded-xl p-6">
                        <h5 class="text-sm font-bold text-primary mb-3">Tambah Feedback Baru</h5>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xs text-on-surface-variant font-medium">Rating:</span>
                            @for($i = 1; $i <= 5; $i++)
                            <button class="material-symbols-outlined text-xl text-outline-variant/40 hover:text-amber-400 transition-colors" style="font-variation-settings: 'FILL' 1;">star</button>
                            @endfor
                        </div>
                        <div class="flex gap-3 mb-4">
                            <select class="px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm flex-shrink-0">
                                <option>Masukan</option>
                                <option>Keluhan</option>
                            </select>
                            <input class="flex-1 px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm placeholder:text-on-surface-variant/50" placeholder="Judul feedback..." type="text"/>
                        </div>
                        <textarea class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm placeholder:text-on-surface-variant/50 resize-none mb-4" placeholder="Detail keluhan atau masukan..." rows="3"></textarea>
                        <button class="px-6 py-3 bg-primary text-on-primary font-bold rounded-full text-sm hover:scale-[1.02] transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">send</span>
                            Kirim Feedback
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Client Info -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pelanggan</h4>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden">
                            <img alt="Client" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxHre-4uFYld2wZtLF0NgrbS6a89eRAYMb1rRv0sjAKY5cs1LiAfwtK4-dYhELfOfkCFm4F8VM4iZuBs1BPKvbkQ5VaZDirOPqraOory9dUWZ8a1sRnhdDAFoR2toPhkSIV_f-G4v_KUhk1IAIsbYODgsiKIBf-r7xmcRVc9kaMmCytZL2Z3p1f0zm_q-2K0haSlhakwtlaunp6PaKiL-kt8gB49SBuFvAGBTo_8YXs2hyE_6uIQagx2Y63v3qArjmJPdUn6BykiMW"/>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">Eleanor Shellstrop</p>
                            <p class="text-xs text-on-surface-variant">e.shellstrop@company.com</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                            <span class="text-on-surface font-medium">+1 (555) 123-4567</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                            <span class="text-on-surface font-medium">Manhattan, New York</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pembayaran</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Metode</span>
                            <span class="text-sm font-bold text-on-surface">Transfer Bank</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">DP Dibayar</span>
                            <span class="text-sm font-bold text-primary">$2,343.00 (50%)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Sisa Tagihan</span>
                            <span class="text-sm font-bold text-error">$2,343.00</span>
                        </div>
                        <div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: 50%"></div>
                        </div>
                        <p class="text-[10px] text-outline text-center">50% dibayar — Sisa saat pengiriman</p>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pengiriman</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Prioritas</span>
                            <span class="text-sm font-bold text-on-surface">Standar (6-8 minggu)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Perkiraan Pengiriman</span>
                            <span class="text-sm font-bold text-on-surface">Nov 10, 2023</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Alamat</span>
                            <span class="text-sm font-bold text-on-surface text-right max-w-[160px]">425 Park Ave, Apt 12B, Manhattan, NY</span>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">note</span>
                        Instruksi Khusus
                    </h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Pelanggan memilih finishing minyak natural. Meja harus muat melalui pintu lebar 86 cm — periksa opsi pelepasan kaki. Pengiriman dijadwalkan pagi hari kerja.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
