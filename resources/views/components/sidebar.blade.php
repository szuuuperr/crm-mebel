@props(['activePage' => 'dashboard'])

@php
    $navItems = [
        ['name' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard', 'route' => 'dashboard'],
        ['name' => 'products', 'label' => 'Produk', 'icon' => 'chair', 'route' => 'products'], 
        ['name' => 'sales', 'label' => 'Penjualan', 'icon' => 'receipt_long', 'route' => 'sales'],
        ['name' => 'projects', 'label' => 'Proyek', 'icon' => 'handyman', 'route' => 'projects.index'],
        ['name' => 'customers', 'label' => 'Pelanggan', 'icon' => 'group', 'route' => 'customers'],
        ['name' => 'settings', 'label' => 'Pengaturan', 'icon' => 'settings', 'route' => 'settings'],
    ];
@endphp

<aside class="h-screen w-72 fixed left-0 top-0 border-r-0 bg-stone-50 dark:bg-stone-950 flex flex-col py-8 px-6 z-50">
    <div class="mb-12 px-1">
        <div class="flex items-flex-start gap-3">
            <div class="w-1 h-100 rounded-lg bg-primary flex items-center justify-center text-on-primary">
            </div>
            <div>
                <h1 class="text-xl font-black text-stone-900 dark:text-stone-50 tracking-tight">Web CRM</h1>
                <h1 class="text-xl font-black text-stone-900 dark:text-stone-50 tracking-tight">Produk Mebel</h1>
                <p class="text-[10px] font-medium text-on-surface-variant/70 uppercase tracking-widest">Pengelolaan Data Produk Mebel</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-2">
        @foreach($navItems as $item)
            @if($activePage === $item['name'])
                <a class="flex items-center gap-4 text-stone-900 dark:text-stone-50 font-bold border-l-4 border-stone-800 dark:border-stone-200 pl-4 py-3 bg-stone-100 dark:bg-stone-900 rounded-r-xl transition-all duration-300 scale-[0.98]" href="{{ route($item['route']) }}">
                    <span class="material-symbols-outlined" @if($item['name'] === 'analytics') style="font-variation-settings: 'FILL' 1;" @endif>{{ $item['icon'] }}</span>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @else
                <a class="flex items-center gap-4 text-stone-500 dark:text-stone-400 pl-5 hover:text-stone-700 transition-colors py-3 rounded-xl hover:bg-stone-200/50 dark:hover:bg-stone-800/50 group transition-all duration-300" href="{{ route($item['route']) }}">
                    <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <div class="mt-auto pt-8 border-t border-stone-200/50 dark:border-stone-800/50 space-y-2"> 
        <a class="w-full bg-primary text-on-primary py-4 rounded-full font-bold flex items-center justify-center gap-2 shadow-lg shadow-primary/10 hover:scale-[1.02] active:scale-[0.98] transition-all mb-4" href="{{ route('orders.create') }}">
            <span class="material-symbols-outlined">add</span>
            <span>Buat Pesanan Baru</span>
        </a>
        <a class="flex items-center gap-4 text-stone-500 dark:text-stone-400 pl-5 hover:text-stone-700 transition-colors py-2 rounded-lg" href="{{ route('profile') }}">
            <span class="material-symbols-outlined">person</span>
            <span class="text-sm font-medium">Profile</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 text-stone-500 dark:text-stone-400 pl-5 hover:text-error transition-colors py-2 rounded-lg text-left">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>
