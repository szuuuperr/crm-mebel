@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Notifikasi</h2>
            <p class="text-on-surface-variant mt-1">Tetap terkini tentang pesanan, pesan, dan aktivitas bengkel</p>
        </div>
        <button class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">done_all</span>
            Tandai Semua Sudah Dibaca
        </button>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-surface-container-low p-2 rounded-full flex gap-2 mb-8 w-fit">
        <button class="px-6 py-2 bg-primary text-on-primary rounded-full text-sm font-semibold">Semua</button>
        <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Belum Dibaca <span class="ml-1 px-1.5 py-0.5 bg-error text-on-error text-[10px] font-bold rounded-full">3</span></button>
        <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Pesanan</button>
        <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Pesan</button>
        <button class="px-6 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-full text-sm font-medium transition-all">Sistem</button>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <div class="col-span-8">
            <!-- Today -->
            <div class="mb-8">
                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-outline-variant/30"></span> Hari Ini
                </h4>
                <div class="space-y-3">
                    @php $todayNotifs = [
                        ['icon'=>'local_shipping','color'=>'bg-blue-100 text-blue-700','title'=>'Status pesanan #INV-8821 diperbarui','desc'=>'Meja Walnut Live Edge telah dipindahkan ke tahap "Dalam Produksi".','time'=>'2 jam lalu','unread'=>true,'type'=>'order'],
                        ['icon'=>'chat_bubble','color'=>'bg-primary/10 text-primary','title'=>'Pesan baru dari Eleanor Shellstrop','desc'=>'"Hai, bisa kita diskusikan opsi finishing untuk meja walnut? Saya memikirkan tentang..."','time'=>'3 jam lalu','unread'=>true,'type'=>'message'],
                        ['icon'=>'star','color'=>'bg-amber-100 text-amber-700','title'=>'Marcus Sterling memberikan ulasan bintang 5','desc'=>'Meja Live-Edge Anda mendapat rating sempurna! "Keahlian luar biasa..."','time'=>'5 jam lalu','unread'=>true,'type'=>'review'],
                    ]; @endphp
                    @foreach($todayNotifs as $n)
                    <div class="flex items-start gap-4 p-5 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-all {{ $n['unread'] ? 'border-l-4 border-primary' : '' }}">
                        <div class="w-11 h-11 rounded-full {{ $n['color'] }} flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">{{ $n['icon'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h5 class="text-sm font-bold text-on-surface {{ $n['unread'] ? '' : 'font-medium' }}">{{ $n['title'] }}</h5>
                                <span class="text-[10px] text-outline flex-shrink-0 ml-4">{{ $n['time'] }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1 truncate">{{ $n['desc'] }}</p>
                        </div>
                        @if($n['unread'])
                        <div class="w-2.5 h-2.5 rounded-full bg-primary flex-shrink-0 mt-1.5"></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Yesterday -->
            <div class="mb-8">
                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-outline-variant/30"></span> Kemarin
                </h4>
                <div class="space-y-3">
                    @php $yestNotifs = [
                        ['icon'=>'inventory','color'=>'bg-orange-100 text-orange-700','title'=>'Peringatan stok menipis: American Walnut','desc'=>'Hanya tersisa 3 lembar di inventaris. Pertimbangkan untuk segera mengisi ulang.','time'=>'Kemarin, 16:30','unread'=>false],
                        ['icon'=>'payments','color'=>'bg-emerald-100 text-emerald-700','title'=>'Pembayaran diterima — #INV-8819','desc'=>'Julian Varkas membayar Rp 1.850.000 untuk Lemari Apoteker. Saldo: Rp 0','time'=>'Kemarin, 14:15','unread'=>false],
                        ['icon'=>'event','color'=>'bg-purple-100 text-purple-700','title'=>'Segera: Konsultasi klien besok','desc'=>'Pertemuan dengan Sarah Mitchell pukul 10:00 — Diskusi Meja Kantor Kustom','time'=>'Kemarin, 09:00','unread'=>false],
                    ]; @endphp
                    @foreach($yestNotifs as $n)
                    <div class="flex items-start gap-4 p-5 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-all">
                        <div class="w-11 h-11 rounded-full {{ $n['color'] }} flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">{{ $n['icon'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h5 class="text-sm font-medium text-on-surface">{{ $n['title'] }}</h5>
                                <span class="text-[10px] text-outline flex-shrink-0 ml-4">{{ $n['time'] }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1 truncate">{{ $n['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Earlier -->
            <div>
                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-8 h-px bg-outline-variant/30"></span> Awal Minggu Ini
                </h4>
                <div class="space-y-3">
                    @php $earlier = [
                        ['icon'=>'task_alt','color'=>'bg-emerald-100 text-emerald-700','title'=>'Proyek "Rak Buku Oak" ditandai selesai','desc'=>'Semua milestone tercapai. Siap untuk pengiriman akhir.','time'=>'2 hari lalu'],
                        ['icon'=>'group_add','color'=>'bg-primary/10 text-primary','title'=>'Pelanggan baru terdaftar: Amara Osei','desc'=>'Dirujuk oleh Sienna Rossi. Tertarik dengan furniture kamar tidur kustom.','time'=>'3 hari lalu'],
                        ['icon'=>'update','color'=>'bg-surface-container-high text-on-surface-variant','title'=>'Pemeliharaan sistem selesai','desc'=>'Semua sistem telah diperbarui. Tidak perlu tindakan.','time'=>'4 hari lalu'],
                    ]; @endphp
                    @foreach($earlier as $n)
                    <div class="flex items-start gap-4 p-5 bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-all">
                        <div class="w-11 h-11 rounded-full {{ $n['color'] }} flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">{{ $n['icon'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h5 class="text-sm font-medium text-on-surface">{{ $n['title'] }}</h5>
                                <span class="text-[10px] text-outline flex-shrink-0 ml-4">{{ $n['time'] }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1 truncate">{{ $n['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Ringkasan</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Belum Dibaca</span>
                            <span class="px-3 py-1 bg-error text-on-error text-xs font-bold rounded-full">3</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Pesanan</span>
                            <span class="text-sm font-bold text-on-surface">4</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Pesan</span>
                            <span class="text-sm font-bold text-on-surface">2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-on-surface-variant">Sistem</span>
                            <span class="text-sm font-bold text-on-surface">3</span>
                        </div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Pengaturan Notifikasi</h4>
                    <div class="space-y-4">
                        @php $notiPrefs = [
                            ['label'=>'Pembaruan Pesanan','on'=>true],
                            ['label'=>'Pesan Pelanggan','on'=>true],
                            ['label'=>'Peringatan Stok','on'=>true],
                            ['label'=>'Pembaruan Sistem','on'=>false],
                        ]; @endphp
                        @foreach($notiPrefs as $p)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-on-surface">{{ $p['label'] }}</span>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input {{ $p['on'] ? 'checked' : '' }} class="sr-only peer" type="checkbox"/>
                                <div class="w-11 h-6 bg-surface-container-high rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
