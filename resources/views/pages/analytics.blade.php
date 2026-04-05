@extends('layouts.app')

@section('title', 'Wawasan Kinerja')

@section('content')
<!-- Main Content Canvas -->
<div class="pt-28 px-10 pb-12 min-h-screen">
    <!-- Header & Action Row -->
    <div class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-primary">Wawasan Kinerja</h1>
            <p class="text-on-surface-variant mt-2">Gambaran menyeluruh tentang pertumbuhan dan metrik produksi bengkel Anda.</p>
        </div>
        <div class="flex gap-4">
            <button class="flex items-center gap-2 px-6 py-3 bg-surface-container-highest rounded-full text-primary font-bold hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined">filter_list</span>
                <span>12 Bulan Terakhir</span>
            </button>
            <button class="flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-full font-bold hover:scale-[1.02] transition-transform shadow-xl shadow-primary/20">
                <span class="material-symbols-outlined">picture_as_pdf</span>
                <span>Ekspor ke PDF</span>
            </button>
        </div>
    </div>

    <!-- Bento Grid Analytics -->
    <div class="grid grid-cols-12 gap-8">
        <!-- Revenue Trend Chart -->
        <div class="col-span-8 bg-surface-container-lowest rounded-xl p-8 flex flex-col">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-xl font-bold">Pertumbuhan Pendapatan</h3>
                    <p class="text-sm text-on-surface-variant">Pendapatan bulanan dari semua lini furniture</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-primary"></span><span class="text-xs font-medium text-on-surface-variant">Pesanan Kustom</span></div>
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-primary-fixed-dim"></span><span class="text-xs font-medium text-on-surface-variant">Stok Produk</span></div>
                </div>
            </div>
            <div class="flex-1 w-full h-64 flex items-end justify-between gap-2 px-4 relative">
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-5">
                    <div class="border-t border-on-surface w-full"></div>
                    <div class="border-t border-on-surface w-full"></div>
                    <div class="border-t border-on-surface w-full"></div>
                    <div class="border-t border-on-surface w-full"></div>
                </div>
                @php
                    $months = [
                        ['month' => 'Jan', 'stock' => 'h-24', 'custom' => 'h-32'],
                        ['month' => 'Feb', 'stock' => 'h-16', 'custom' => 'h-40'],
                        ['month' => 'Mar', 'stock' => 'h-28', 'custom' => 'h-48'],
                        ['month' => 'Apr', 'stock' => 'h-20', 'custom' => 'h-36'],
                        ['month' => 'May', 'stock' => 'h-32', 'custom' => 'h-56'],
                        ['month' => 'Jun', 'stock' => 'h-12', 'custom' => 'h-24'],
                    ];
                @endphp
                @foreach($months as $m)
                <div class="flex flex-col flex-1 gap-1 items-center group">
                    <div class="w-full rounded-t-lg bg-primary-fixed-dim {{ $m['stock'] }} group-hover:bg-primary-fixed transition-colors"></div>
                    <div class="w-full rounded-t-lg bg-primary {{ $m['custom'] }} group-hover:opacity-90 transition-opacity"></div>
                    <span class="text-[10px] uppercase font-bold text-outline mt-3">{{ $m['month'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-span-4 bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay bg-[url('https://www.transparenttextures.com/patterns/wood-pattern.png')]"></div>
            <h3 class="text-xl font-bold mb-6 relative z-10">Ringkasan Tahunan</h3>
            <div class="space-y-8 relative z-10 ">
                <div>
                    <p class="text-on-primary/60 text-xs font-semibold uppercase tracking-widest mb-1">Total Pendapatan</p>
                    <p class="text-4xl font-extrabold tracking-tighter">$142,500.00</p>
                    <div class="flex items-center gap-1 mt-2 text-primary-fixed">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span class="text-xs font-bold">+12,4% dari tahun lalu</span>
                    </div>
                </div>
                <div>
                    <p class="text-on-primary/60 text-xs font-semibold uppercase tracking-widest mb-1">Proyek Selesai</p>
                    <p class="text-4xl font-extrabold tracking-tighter">84</p>
                    <p class="text-[10px] mt-1 text-on-primary/40">12 saat ini dalam antrian produksi</p>
                </div>
                <button class="w-full bottom-2 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full font-bold transition-all text-sm">
                    Lihat Buku Besar Detail
                </button>
            </div>
        </div>

        <!-- Top Selling Categories -->
        <div class="col-span-7 bg-surface-container-low rounded-xl p-8">
            <h3 class="text-xl font-bold mb-6">Kategori Terlaris</h3>
            <div class="space-y-6">
                @php
                    $categories = [
                        ['name' => 'Kursi Artisan', 'pct' => 42, 'icon' => 'chair'],
                        ['name' => 'Meja Makan', 'pct' => 28, 'icon' => 'table_bar'],
                        ['name' => 'Set Kamar Tidur', 'pct' => 18, 'icon' => 'bed'],
                    ];
                @endphp
                @foreach($categories as $cat)
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 rounded-lg bg-surface-container-lowest flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-3xl">{{ $cat['icon'] }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">{{ $cat['name'] }}</span>
                            <span class="text-on-surface-variant font-medium">{{ $cat['pct'] }}%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $cat['pct'] }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Seasonal Growth Matrix -->
        <div class="col-span-5 bg-surface-container-lowest rounded-xl p-8 relative overflow-hidden group">
            <h3 class="text-xl font-bold mb-2">Tren Musiman</h3>
            <p class="text-sm text-on-surface-variant mb-8">Kapasitas produksi vs. permintaan</p>
            <div class="grid grid-cols-2 gap-4">
                @php
                    $seasons = [
                        ['name' => 'Semi', 'pct' => '+8%', 'desc' => 'Peningkatan permintaan furniture outdoor', 'highlight' => false],
                        ['name' => 'Panas', 'pct' => '+15%', 'desc' => 'Puncak hadiah pernikahan & registrasi rumah baru', 'highlight' => false],
                        ['name' => 'Gugur', 'pct' => '+24%', 'desc' => 'Puncak musiman utama bengkel', 'highlight' => true],
                        ['name' => 'Dingin', 'pct' => '+5%', 'desc' => 'Fokus pada produk kustom kecil musiman', 'highlight' => false],
                    ];
                @endphp
                @foreach($seasons as $season)
                <div class="p-5 {{ $season['highlight'] ? 'bg-primary-fixed/30 border-primary/10' : 'bg-surface-container-low border-transparent hover:border-primary/20' }} rounded-lg border transition-all cursor-default">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">{{ $season['name'] }}</p>
                    <p class="text-xl font-extrabold text-primary">{{ $season['pct'] }}</p>
                    <div class="mt-2 text-[10px] text-on-surface-variant/60 leading-tight">{{ $season['desc'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Secondary Insight Section -->
    <div class="mt-8 grid grid-cols-3 gap-8">
        <div class="glass-card rounded-xl p-8 border border-white/50 flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-secondary-container text-sm">psychology</span>
                </div>
                <span class="font-bold text-primary">Wawasan Bengkel</span>
            </div>
            <p class="text-sm leading-relaxed text-on-surface-variant">
                "Kayu walnut tetap menjadi material paling diminati kuartal ini. Pertimbangkan untuk memesan stok terlebih dahulu untuk puncak musim Gugur mendatang agar waktu tunggu 4 minggu tetap terjaga."
            </p>
        </div>
        <div class="col-span-2 bg-surface-container-high rounded-xl p-8 flex items-center justify-between">
            <div class="flex gap-6 items-center">
                <div class="w-16 h-16 rounded-full border-4 border-primary border-t-outline-variant/30 flex items-center justify-center">
                    <span class="text-sm font-black text-primary">76%</span>
                </div>
                <div>
                    <h4 class="font-bold text-lg">Efisiensi Bengkel</h4>
                    <p class="text-sm text-on-surface-variant">Optimalisasi lini produksi naik 4% dari bulan lalu.</p>
                </div>
            </div>
            <div class="flex -space-x-4">
                <img alt="team member" class="w-12 h-12 rounded-full border-2 border-surface shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDNdxhwo4PZS3iuk6qBRtTdtONHscbTxJGl3BpIOoSYBmNdUu-CLc_-OBKjts6tYxYv9y3GWkAMirsOV0lS__qFAai-GD2zyf6phyrUd2eJ5w3NFS-_9zBGpTaAONOpyggURINVi0q6OKVyw6a1eHMAzikm3rThqQ_IWivp0R5e3Q092iwWmg8xvLTaUoiGhAsp3NSg6AWbTDWvZU-D1v7pIMDGZtr9R8Nij50qX1YtLNxdaApDdPlwCDegeZWrrMK1otaSTmtnOMN3"/>
                <img alt="team member" class="w-12 h-12 rounded-full border-2 border-surface shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDI4PzcO1NLozTme12-lymNsUq08eXYJ64jgc5Dqu0YRTUBhTPtvWuzgbWlmGLYl8hYCzs_27CHWFU4JeO8zISfppaKKCdS3mq0U3iJGYP2kUZluQCQxEwC1ti2A-u69QV2DdAk4CU_E3DBCqTsilsZZPUC_OloPYA1AKOkhDkmaPKHbZ0Sa2JpgCE-LElr5grvmt0_EJaggH_7JG-5DufCN62gh9dEInL19wanzFwaR0CqQWZdvL9GgxxyS1FFIseFWBu2btBmdSq7"/>
                <img alt="team member" class="w-12 h-12 rounded-full border-2 border-surface shadow-md" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmy3RmonaXca8Da1xPZf8HnJUi1a-nu3PTxRVXkz6jsYGGGsChsBJ4GmUM0ReoRLTDOyJTUbm7XdjHeQSCRmOn3ZKTRl7076AKdcteEqi-YirgeHa5OJKPb_JMpHAf8TTtdvfznWSRL2RncamvlwRRqzbSZjjeyedga8XeXzZgWh_0vimw_pYUnkgzon6KUnS0lg_ydF2FfyZsegL-LjwvGqFs8m3cLLLJofxCNzJ_hrNKEAKSkkgCOY9-Bdf6gmVuW51e6ZSIhdfx"/>
                <div class="w-12 h-12 rounded-full border-2 border-surface bg-primary text-on-primary flex items-center justify-center font-bold text-xs">+5</div>
            </div>
        </div>
    </div>
</div>
@endsection
