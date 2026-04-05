@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Profile Hero -->
     <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('settings') }}">Pengaturan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Profil</span>
    </nav>

    <div class="bg-primary rounded-xl p-10 mb-10 relative overflow-hidden">
        <div class="absolute -right-16 -bottom-16 opacity-10">
            <span class="material-symbols-outlined text-[200px]">handyman</span>
        </div>
        <div class="relative z-10 flex items-center gap-10">
            <div class="w-36 h-36 rounded-xl overflow-hidden shadow-2xl ring-4 ring-white/20">
                <img alt="Profile" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRqC-TvVYpbUEvjwJqRZACZQqEg59kTR3V3VAfb6r68ZF5SWqjVVR3yEUvrmFeHMvHwYA_KnqNgK-VMvNz3LdmhiONtmLdYBYzp8Fg04q1RKymSIgNCCMGStqeuCS-bRHdVIAiU-KtdLsN9eQXD-5FXUBAZwkwENHBnWpzReC7lIT78uDuFJuAbnh8kvhCNWThvhGsYEIDjJUquQZZ_Q3LSbDxoRX1Yp1x3L-hvrEcAyqKfeuepWBdfRtvN18SSOIGc2lltzDGI8QX"/>
            </div>
            <div class="text-on-primary flex-1">
                <h1 class="text-4xl font-extrabold font-headline tracking-tight mb-1">Elias Thorne</h1>
                <p class="text-on-primary/70 text-lg font-medium mb-4">Lead Carpenter & Founder</p>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-xs font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span> Tukang Ahli
                    </span>
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-xs font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">location_on</span> Portland Atelier
                    </span>
                    <span class="px-4 py-1.5 bg-white/10 rounded-full text-xs font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">calendar_today</span> Sejak 2018
                    </span>
                </div>
            </div>
            <a class="px-6 py-3 bg-white text-primary font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-2 flex-shrink-0" href="{{ route('settings') }}">
                <span class="material-symbols-outlined text-sm">edit</span> Ubah Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10">
        <div class="col-span-8 space-y-8">
            <!-- Stats -->
            <div class="grid grid-cols-4 gap-6">
                @php $stats = [
                    ['label'=>'Total Proyek','value'=>'142','icon'=>'handyman','color'=>'bg-primary text-on-primary'],
                    ['label'=>'Pesanan Aktif','value'=>'8','icon'=>'pending_actions','color'=>'bg-secondary-container text-on-secondary-container'],
                    ['label'=>'Rating Pelanggan','value'=>'4.9','icon'=>'star','color'=>'bg-primary-container text-on-primary-container'],
                    ['label'=>'Tahun Aktif','value'=>'5+','icon'=>'workspace_premium','color'=>'bg-surface-container-high text-primary'],
                ]; @endphp
                @foreach($stats as $s)
                <div class="{{ $s['color'] }} rounded-xl p-6 relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -right-2 -bottom-2 text-6xl opacity-10">{{ $s['icon'] }}</span>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">{{ $s['label'] }}</p>
                    <p class="text-3xl font-black font-headline relative z-10">{{ $s['value'] }}</p>
                </div>
                @endforeach
            </div>

            <!-- Bio -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Tentang</h3>
                <p class="text-on-surface-variant leading-relaxed mb-4">Berdedikasi untuk melestarikan teknik pertukangan tradisional sambil mengintegrasikan estetika desain modern ke dalam setiap karya khusus. Spesialisasi furniture live-edge, meja makan pusaka, dan reproduksi modern abad pertengahan.</p>
                <p class="text-on-surface-variant leading-relaxed">Dengan pengalaman lebih dari 5 tahun di pertukangan kayu halus, saya telah menyelesaikan 142+ komisi kustom untuk klien residensial dan komersial di seluruh Pacific Northwest.</p>
            </div>

            <!-- Skills -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Keahlian & Spesialisasi</h3>
                <div class="grid grid-cols-2 gap-4">
                    @php $skills = [
                        ['name'=>'Furniture Live-Edge','level'=>95,'icon'=>'nature'],
                        ['name'=>'Pertukangan Tradisional','level'=>90,'icon'=>'carpenter'],
                        ['name'=>'Finishing Kayu','level'=>88,'icon'=>'brush'],
                        ['name'=>'Ukiran Tangan','level'=>82,'icon'=>'handyman'],
                        ['name'=>'Pemrograman CNC','level'=>70,'icon'=>'precision_manufacturing'],
                        ['name'=>'Desain & CAD','level'=>75,'icon'=>'draw'],
                    ]; @endphp
                    @foreach($skills as $sk)
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-sm">{{ $sk['icon'] }}</span>
                                <span class="text-sm font-bold text-on-surface">{{ $sk['name'] }}</span>
                            </div>
                            <span class="text-xs font-bold text-primary">{{ $sk['level'] }}%</span>
                        </div>
                        <div class="h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $sk['level'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-6">Aktivitas Terbaru</h3>
                @php $acts = [
                    ['action'=>'Menyelesaikan proyek "Set Meja Makan Walnut" untuk Eleanor Vance','time'=>'2 jam lalu','icon'=>'task_alt','color'=>'bg-primary/10 text-primary'],
                    ['action'=>'Mengunggah 6 foto progres untuk Heritage Oak Table','time'=>'Kemarin','icon'=>'photo_library','color'=>'bg-secondary-container text-on-secondary-container'],
                    ['action'=>'Menerima rating bintang 5 dari Marcus Sterling','time'=>'2 hari lalu','icon'=>'star','color'=>'bg-amber-100 text-amber-700'],
                    ['action'=>'Membuat proyek baru "Rak Buku Mahogani Kustom"','time'=>'3 hari lalu','icon'=>'add_circle','color'=>'bg-primary/10 text-primary'],
                ]; @endphp
                @foreach($acts as $a)
                <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-surface-container-low transition-colors">
                    <div class="w-10 h-10 rounded-full {{ $a['color'] }} flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-sm">{{ $a['icon'] }}</span>
                    </div>
                    <div>
                        <p class="text-sm text-on-surface">{{ $a['action'] }}</p>
                        <p class="text-xs text-outline mt-1">{{ $a['time'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Kontak</h4>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">mail</span><span class="text-sm font-medium">elias@artisanalatelier.com</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">call</span><span class="text-sm font-medium">+1 (503) 555-0172</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">location_on</span><span class="text-sm font-medium">Portland, OR 97201</span></div>
                        <div class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-[18px]">language</span><span class="text-sm font-medium">artisanalatelier.com</span></div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Karya Terbaru</h4>
                    <div class="grid grid-cols-2 gap-3">
                        @php $works = [
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuDtYYLrcOQo6TP8T3P9MUajI9LAOO912pWXVG3GhDgeiPjzdpDniXpifVF6NQOxv5p6w2vCA8Zu433DpijsTV_cflDd3bha5iaD-wiJiwBhvB0QrKedhjJ65HzIUuizZCwdeFvZ0SnjW9xLheSspFK5GC1BTIGnDVzr1Jtrxo3Kn-66J56webKXb7CCb4fHkN0_1EZmSWsL4wAHzDGyRKE6Vsic4TAccCV5i4ktiCslDPZi846_8ln6I-n8ItPAW6oWYS7r6EJsraFD',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuCOQojRGH3OYUwn0rhJlAf_LX2bdNw48FdOgiR-TbfZpcFbnhwhViI65af0ISxKRKcqN2CucleKlarhrECbwCqyQBI1fd3pnPwrNh3Eux2YAHYVuM7-xInep6YeJ_QWYZG25OFtdy4LOZ0pNsQfiuUyVcaR7L2QQvDn58vt1IjNy8JhNnqJ9fHXij-M7JV0GT19biEf8ogaTI8f5zII-HjMTXnKEJdpHHF6vTAM9UeX3uNKnVxU6Qo1X2cPlq0ULGNz6X3u8uAYeNG4',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuDKFebMRq9Mv8G6uRYHnx15xjuCdNfW7_yxq7HKhHtEe40Uf2ryVsz35paDo4GIEZh5hkKlHpOPcR3_zEFEspWsUGIgGa7U9H9WDOjYDBSFXmVER74oUmdcXYqum1pzjIF8xlEMefEia7I6y0CMfKiD5PS85ew1KImhmYucok750UkVGc86FvMzpaAllUkV3jk6KQzHrjq_sh-StyfDBW3j2APDJn2n17R5qZkUuP7N3Bsjw4iHOgNMCt4LxrLak-H_XUXL05kkWUcY',
                        ]; @endphp
                        @foreach($works as $w)
                        <div class="h-28 rounded-lg overflow-hidden group cursor-pointer">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $w }}"/>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Material Pilihan</h4>
                    <div class="flex flex-wrap gap-2">
                        @php $mats = [['n'=>'Walnut','c'=>'#4a3728'],['n'=>'Oak','c'=>'#c19a6b'],['n'=>'Mahogany','c'=>'#4E2A1E'],['n'=>'Teak','c'=>'#8E593C']]; @endphp
                        @foreach($mats as $m)
                        <span class="flex items-center gap-2 px-3 py-2 bg-surface-container-low rounded-lg">
                            <div class="w-4 h-4 rounded-full" style="background-color: {{ $m['c'] }}"></div>
                            <span class="text-xs font-bold text-on-surface">{{ $m['n'] }}</span>
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
