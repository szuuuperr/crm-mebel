<header class="fixed top-0 right-0 w-[calc(100%-18rem)] z-40 bg-stone-50/80 dark:bg-stone-950/80 backdrop-blur-xl flex justify-between items-center h-20 px-10">
    <div class="flex items-center bg-surface-container-high rounded-full px-6 py-2 w-96">
        <span class="material-symbols-outlined text-outline mr-3">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder-on-surface-variant font-body" placeholder="Cari Projek atau Inventori..." type="text"/>
    </div>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('notifications') }}" class="relative p-2 text-stone-500 hover:text-stone-900 transition-colors">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface"></span>
            </a>
            <a href="{{ route('schedule') }}" class="p-2 text-stone-500 hover:text-stone-900 transition-colors">
                <span class="material-symbols-outlined">calendar_today</span>
            </a>
        </div>
        <div class="flex items-center gap-3 pl-4 border-l border-outline-variant/20">
            <div class="text-right">
                <p class="text-sm font-bold text-on-surface leading-tight">Julian Thorne</p>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-tighter mt-1 font-bold">Lead Carpenter</p>
            </div>
            <a href="{{ route('profile') }}">
                <img alt="Lead Carpenter Profile" class="w-10 h-10 rounded-full object-cover ring-2 ring-primary/10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZDSDOiwRhwyGRYIJa7mN0i0g8bMKdMesH2MCjvR7uoG2m0eylA2zJ52G6c8Mdj7wpdPXQRLEB_tIXCf-NZW85oYym2hAI2kUzXCZGSIsD1P-vIeRUg8rH5OikpzVjATgA4kMQmck8s5fPaSBZ-3Tgw4kRuR33NsG1iV0HYbFu0I15eY1TTDxOXebh6Y6qpL9xhvsUYeN_mbph7_pUC-N-IPOYcxwegXy3G-_7LO06mijAu1Pqa_N2KTvVRT3reejJwvFLBeRDeP3"/>
            </a>
        </div>
    </div>
</header>
