@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<!-- Split Screen Container -->
<main class="flex w-full h-screen overflow-hidden">
    <!-- Left Side: Visual Anchor -->
    <section class="hidden md:flex md:w-1/2 relative overflow-hidden group">
        <img alt="Artisanal Workshop" class="absolute inset-0 w-full h-full object-cover" src="https://i.pinimg.com/1200x/3e/9f/b0/3e9fb0118f218819f594532e4b0f30c6.jpg"/>
        <!-- Overlay for Depth -->
        <div class="absolute inset-0 bg-primary/20 backdrop-brightness-75 mix-blend-multiply"></div>
        <!-- Branding Overlay -->
        <div class="relative z-10 p-16 flex flex-col justify-between h-full w-full">
            <div class="flex items-center gap-3">
                <div class="w-1 h-12 bg-surface-container-lowest rounded-lg flex items-center justify-center shadow-lg">
                </div>
                <span class="text-surface-container-lowest text-2xl font-extrabold tracking-tighter font-headline">Web CRM Produk Mebel</span>
            </div>
            <div class="max-w-md">
                <h2 class="text-surface-container-lowest text-5xl font-extrabold leading-tight tracking-tight font-headline">
                    Membentuk <br/>Masa Depan <br/>Kerajinan Kayu.
                </h2>
                <p class="mt-6 text-surface-container-lowest/80 text-lg leading-relaxed font-body">
                    Selamat datang kembali. Kelola inventaris, lihat pesanan, dan terhubung dengan pelanggan.
                </p>
            </div>
            <div class="flex items-center gap-8 text-surface-container-lowest/60 text-sm font-medium">
                <span>SEJAK. 2026</span>
                <span class="w-1 h-1 bg-surface-container-lowest/40 rounded-full"></span>
                <span>SUMBER BERKELANJUTAN</span>
            </div>
        </div>
    </section>

    <!-- Right Side: Login Form -->
    <section class="w-full md:w-1/2 flex flex-col justify-center items-center px-6 md:px-24 bg-surface relative">
        <!-- Mobile Logo -->
        <div class="md:hidden mb-12 flex flex-col items-center gap-2">
            <span class="material-symbols-outlined text-primary text-5xl">architecture</span>
            <span class="text-primary text-xl font-extrabold tracking-tighter font-headline">Web CRM Produk Mebel</span>
        </div>

        <div class="w-full max-w-md border-2 border-primary p-8 rounded-lg">
            <header class="mb-10">
                <h1 class="text-3xl font-extrabold text-on-surface tracking-tight font-headline mb-2">Selamat Datang</h1>
                <p class="text-on-surface-variant font-body">Masuk ke dashboard pengrajin Anda</p>
            </header>

            <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                
                {{-- Flash Messages --}}
                @if(session('success'))
                <div class="p-4 bg-green-500 text-white rounded-lg font-medium shadow-sm">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="p-4 bg-red-500 text-white rounded-lg font-medium shadow-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Email Field -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1 font-label" for="email">Email</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant group-focus-within:text-primary transition-colors">mail</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg text-on-surface border-none focus:ring-2 focus:ring-primary-container transition-all font-body placeholder:text-on-surface-variant/50" id="email" name="email" value="{{ old('email') }}" required placeholder="admin@webmebel.com" type="email"/>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-sm font-semibold text-on-surface-variant font-label" for="password">Kata Sandi</label>
                        <a class="text-sm font-medium text-primary hover:underline decoration-primary-container/30 transition-all font-label" href="#">Lupa kata sandi?</a>
                    </div>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg text-on-surface border-none focus:ring-2 focus:ring-primary-container transition-all font-body placeholder:text-on-surface-variant/50" id="password" name="password" required placeholder="••••••••" type="password"/>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-3 px-1">
                    <div class="relative flex items-center">
                        <input class="w-5 h-5 rounded border-none bg-surface-container-high text-primary focus:ring-offset-0 focus:ring-2 focus:ring-primary" id="remember" name="remember" type="checkbox"/>
                    </div>
                    <label class="text-sm font-medium text-on-surface-variant select-none font-body" for="remember">Tetap masuk di perangkat ini</label>
                </div>

                <!-- CTA Button -->
                <button type="submit" class="w-full bg-primary-container text-on-primary py-4 rounded-full font-bold text-lg shadow-lg shadow-primary-container/10 hover:scale-[1.02] active:scale-[0.98] transition-all font-headline flex items-center justify-center gap-2 mt-4">
                    <span>Masuk</span>
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </button>
            </form>

            <!-- Footer Links -->
            <footer class="mt-12 text-center">
                <p class="text-on-surface-variant font-body">
                    Belum terdaftar?
                    <a class="text-primary font-bold hover:underline ml-1" href="#">Minta Akses</a>
                </p>
                <div class="mt-12 flex items-center justify-center gap-6 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all">
                    <span class="material-symbols-outlined text-2xl">eco</span>
                    <span class="material-symbols-outlined text-2xl">handyman</span>
                    <span class="material-symbols-outlined text-2xl">potted_plant</span>
                </div>
            </footer>
        </div>
    </section>
</main>
@endsection
