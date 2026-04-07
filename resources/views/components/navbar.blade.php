@props(['unreadNotifications' => 0])

<header class="fixed top-0 right-0 w-[calc(100%-18rem)] z-40 bg-stone-50/80 dark:bg-stone-950/80 backdrop-blur-xl flex justify-between items-center h-20 px-10">
    <form action="{{ route('search') }}" method="GET" class="flex items-center bg-surface-container-high rounded-full px-6 py-2 w-96 relative" id="searchForm">
        <span class="material-symbols-outlined text-outline mr-3">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder-on-surface-variant font-body" name="q" id="searchInput" placeholder="Cari Projek, Produk, atau Pelanggan..." type="text" value="{{ request('q') }}" autocomplete="off"/>
        <div id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-surface-container-lowest rounded-xl shadow-2xl border border-outline-variant/10 overflow-hidden hidden z-50">
            <div id="searchResultsContent" class="p-4 max-h-96 overflow-y-auto">
            </div>
        </div>
    </form>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('notifications') }}" class="relative p-2 text-stone-500 hover:text-stone-900 transition-colors">
                <span class="material-symbols-outlined">notifications</span>
                @if($unreadNotifications > 0)
                <span class="absolute top-1 right-1 w-4 h-4 bg-error rounded-full text-[8px] text-white flex items-center justify-center font-bold">{{ $unreadNotifications }}</span>
                @else
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface"></span>
                @endif
            </a>
            <a href="{{ route('schedule') }}" class="p-2 text-stone-500 hover:text-stone-900 transition-colors">
                <span class="material-symbols-outlined">calendar_today</span>
            </a>
        </div>
        <div class="flex items-center gap-3 pl-4 border-l border-outline-variant/20">
            <div class="text-right">
                <p class="text-sm font-bold text-on-surface leading-tight">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-tighter mt-1 font-bold">{{ auth()->user()->jabatan ?? 'Pegawai' }}</p>
            </div>
            <a href="{{ route('profile') }}">
                @if(auth()->user()->avatar)
                    <img alt="User Profile" class="w-10 h-10 rounded-full object-cover ring-2 ring-primary/10" src="{{ auth()->user()->avatar }}"/>
                @else
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white ring-2 ring-primary/10 font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </a>
        </div>
    </div>
</header>
