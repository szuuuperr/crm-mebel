@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<!-- Content Canvas -->
<div class="pt-28 px-10 pb-12">
    <!-- Page Header & Quick Stats -->
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight">Buku Penjualan</h2>
            <p class="text-on-surface-variant mt-2 font-medium">Melacak setiap transaksi kerajinan artisan</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <div>
                    <p class="text-xs text-outline uppercase font-bold tracking-widest">Pendapatan Hari Ini</p>
                    <p class="text-xl font-bold text-primary">$12,450.00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bento Filter Bar -->
    <div class="grid grid-cols-12 gap-6 mb-8">
        <div class="col-span-8 bg-surface-container-low p-2 rounded-full flex gap-2">
            <button class="px-6 py-2 bg-primary text-on-primary rounded-full text-sm font-semibold transition-all scale-100 hover:scale-[1.02]">Semua Pesanan</button>
            <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Dalam Produksi</button>
            <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Dikirim</button>
            <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Selesai</button>
        </div>
        <div class="col-span-4 flex justify-end">
            <button class="flex items-center gap-2 bg-surface-container-lowest border border-outline-variant/20 px-6 py-2 rounded-full text-sm font-semibold hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-sm">filter_list</span>
                Filter Lanjutan
            </button>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead class="bg-primary text-on-primary">
                <tr>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Faktur</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Pelanggan</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Detail Barang</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest">Jumlah</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @php
                    $orders = [
                        ['inv' => '#INV-8821', 'date' => '24 Okt 2023', 'customer' => 'Eleanor Shellstrop', 'item' => 'Meja Walnut Live Edge', 'itemDesc' => 'Kustom 8-Kursi, Minyak Alami', 'amount' => 'Rp 4.200.000', 'status' => 'Dalam Produksi', 'statusClass' => 'bg-amber-100 text-amber-800', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDxHre-4uFYld2wZtLF0NgrbS6a89eRAYMb1rRv0sjAKY5cs1LiAfwtK4-dYhELfOfkCFm4F8VM4iZuBs1BPKvbkQ5VaZDirOPqraOory9dUWZ8a1sRnhdDAFoR2toPhkSIV_f-G4v_KUhk1IAIsbYODgsiKIBf-r7xmcRVc9kaMmCytZL2Z3p1f0zm_q-2K0haSlhakwtlaunp6PaKiL-kt8gB49SBuFvAGBTo_8YXs2hyE_6uIQagx2Y63v3qArjmJPdUn6BykiMW'],
                        ['inv' => '#INV-8819', 'date' => '22 Okt 2023', 'customer' => 'Julian Varkas', 'item' => 'Lemari Apoteker', 'itemDesc' => 'Pinus Daur Ulang, Hardware Kuningan', 'amount' => 'Rp 1.850.000', 'status' => 'Dikirim', 'statusClass' => 'bg-blue-100 text-blue-800', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhTwqVepyMuVlpx2cYKxT5zchLHoLvANzkE_0dsNO9evd7Y_zF8xpYEaEZqWjE4BCBCOScF0xaOalW6HaoTTuKwSdGQw6_8CHHV0-WMny3evtk-uWissdFSonDO65u2SIEo_tAQGB3mvlJnULlgW1UAWwvn9au4VHpJbY5TmtVgna_ZtvMd2XoBgccdMbD1scLYJFXvRBrLcGQjHUT4kkdRSldpbYG63K1jxo-T7R9k9obzda3Dl62eOE-Xo_JeBhGxk2oe5GKMdDx'],
                        ['inv' => '#INV-8815', 'date' => '20 Okt 2023', 'customer' => 'Mark Henderson', 'item' => 'Rangka Tempat Tidur Minimalis', 'itemDesc' => 'White Oak, Ukuran Queen', 'amount' => 'Rp 2.900.000', 'status' => 'Selesai', 'statusClass' => 'bg-emerald-100 text-emerald-800', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB5F6o4SgCzuGXuiT2DU25N6w7_tkjMFvuSU9bDXIkuuNUrdxvdg8IFrnPA0ScgoF9KLN3zqY87w4DueI571u3rQ1UgbHacZTTbih_QUr61-pz6cg4d2Jcuvz0BMZeYEoBzsO1GxchLYds88Xt0LF38rzlxcgBwLvEzI5G3u6s99EoHNNbX-5XDxSbViPpnh7k6rM3dJkYNeurujYrm6tgKORB5SOmX92UmvbkMgGcjTCux1oMTUfzFPOREly8Ltu4YET4tRQxEVGC5'],
                        ['inv' => '#INV-8812', 'date' => '19 Okt 2023', 'customer' => 'Sarah Mitchell', 'item' => 'Meja Kantor Kurasi', 'itemDesc' => 'Mahogani dengan Inlay Kulit', 'amount' => 'Rp 3.450.000', 'status' => 'Prospek Baru', 'statusClass' => 'bg-stone-100 text-stone-800', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNI7zcBadBW0YGZ_agaI1r3aow55xTXXBbvN9i3Q0f_zw4Rlfdtw5LHJDMFH-EDu8XKnasDxVfbOMYYHEGzHO9LifWKA7jBpxgO9F-6_1_O7HK-GoDyEAaGxDiYi9lbruvVRH-3TDXY15LSpabk5RRDFuQnW6hZIzae8GEW9Ty1bkImrJj8e9ZlpD2K7tO2OL7i00USIICpgrpV4nTztGYkoGitKGaVMs4tgOUfvmrjOIc-97P-29GKu4vwGr1AtBGThZETgLIpmIB'],
                    ];
                @endphp
                @foreach($orders as $order)
                <tr class="hover:bg-surface-container-low transition-colors group">
                    <td class="px-8 py-6">
                        <span class="font-headline font-bold text-primary">{{ $order['inv'] }}</span>
                        <p class="text-xs text-outline mt-0.5">{{ $order['date'] }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-stone-200 overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ $order['avatar'] }}"/>
                            </div>
                            <span class="font-medium text-on-surface">{{ $order['customer'] }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-semibold block">{{ $order['item'] }}</span>
                        <span class="text-xs text-on-surface-variant">{{ $order['itemDesc'] }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="font-headline font-bold text-primary">{{ $order['amount'] }}</span>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $order['statusClass'] }}">
                            {{ $order['status'] }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <button class="text-outline hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">more_vert</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Table Footer / Pagination -->
        <div class="px-8 py-6 bg-surface-container-low flex justify-between items-center">
            <p class="text-sm text-on-surface-variant font-medium">Menampilkan 4 dari 128 transaksi</p>
            <div class="flex gap-2">
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high text-outline transition-colors"><span class="material-symbols-outlined">chevron_left</span></button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-on-primary font-bold shadow-md">1</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high text-on-surface transition-colors">2</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high text-on-surface transition-colors">3</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high text-outline transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
            </div>
        </div>
    </div>

    <!-- Export Section -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="col-span-2 bg-primary p-12 rounded-xl text-on-primary relative overflow-hidden group">
            <div class="relative z-10">
                <h3 class="text-3xl font-extrabold mb-4">Ekspor Catatan Kerajinan</h3>
                <p class="text-on-primary-container max-w-md mb-8">Unduh laporan CSV atau PDF resolusi tinggi untuk dokumentasi pajak dan perencanaan produksi.</p>
                <div class="flex gap-4">
                    <button class="bg-secondary-container text-on-secondary-container px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined">download</span>
                        CSV Keuangan
                    </button>
                    <button class="bg-primary-container text-on-primary-container border border-outline-variant/30 px-8 py-3 rounded-full font-bold hover:bg-primary-container/80 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined">description</span>
                        PDF Proyek
                    </button>
                </div>
            </div>
            <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-surface-tint/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
        </div>
        <div class="bg-surface-container-high p-8 rounded-xl flex flex-col justify-between">
            <div>
                <span class="material-symbols-outlined text-primary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                <h4 class="text-xl font-bold text-primary mb-2">Proyeksi Kuartalan</h4>
                <p class="text-sm text-on-surface-variant">Berdasarkan kecepatan produksi saat ini, kami 12% lebih unggul dari siklus pasokan walnut tahun lalu.</p>
            </div>
            <div class="mt-6 pt-6 border-t border-outline-variant/20">
                <div class="flex justify-between items-end mb-2">
                    <span class="text-xs font-bold uppercase text-outline">Target Tercapai</span>
                    <span class="text-lg font-bold text-primary">82%</span>
                </div>
                <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full" style="width: 82%"></div>
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
