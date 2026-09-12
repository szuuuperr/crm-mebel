<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Portal Pelanggan | @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="shortcut icon" href="{{ asset('icon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed-variant": "#5d4037",
                        "primary-fixed-dim": "#e7bdb1",
                        "secondary-container": "#fadcd2",
                        "on-secondary-fixed-variant": "#56423b",
                        "surface-tint": "#77574d",
                        "outline-variant": "#d4c3be",
                        "surface-container-highest": "#e2e2e2",
                        "on-tertiary-fixed": "#201a18",
                        "surface-container-low": "#f4f4f3",
                        "inverse-surface": "#2f3130",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-background": "#1a1c1c",
                        "secondary-fixed-dim": "#ddc1b7",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e2e2e2",
                        "on-surface": "#1a1c1c",
                        "background": "#f9f9f8",
                        "surface-bright": "#f9f9f8",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "inverse-primary": "#e7bdb1",
                        "inverse-on-surface": "#f1f1f0",
                        "tertiary-container": "#4c4542",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#2c160e",
                        "on-surface-variant": "#504441",
                        "on-tertiary-fixed-variant": "#4c4542",
                        "on-secondary-fixed": "#271812",
                        "surface-dim": "#dadad9",
                        "surface": "#f9f9f8",
                        "on-tertiary-container": "#bdb3af",
                        "primary": "#442a22",
                        "primary-container": "#5d4037",
                        "tertiary": "#352f2c",
                        "on-primary-container": "#d4ada1",
                        "primary-fixed": "#ffdbd0",
                        "secondary-fixed": "#fadcd2",
                        "tertiary-fixed-dim": "#cfc4c0",
                        "secondary": "#6f5a52",
                        "surface-container-high": "#e8e8e7",
                        "surface-container": "#eeeeed",
                        "tertiary-fixed": "#ece0dc",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#766057",
                        "outline": "#827470"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Work Sans"],
                        "label": ["Work Sans"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Work Sans', sans-serif; }
        h1, h2, h3, h4, .font-headline { font-family: 'Manrope', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d4c3be; border-radius: 10px; }
    </style>
    @yield('head')
</head>
<body class="bg-surface text-on-surface min-h-screen">

    {{-- Sidebar Pelanggan --}}
    <div id="app-sidebar" class="transition-all duration-200">
        @include('pelanggan.components.sidebar')
    </div>

    {{-- Main Content Area --}}
    <main id="app-main" class="ml-72 min-h-screen transition-all duration-200">
        {{-- Top Bar --}}
        <div class="sticky top-0 z-30 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30">
            <div class="flex items-center justify-between px-8 py-4">
                <div>
                    <h2 class="text-lg font-bold text-on-surface font-headline">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-xs text-on-surface-variant">@yield('page-subtitle', 'Portal Pelanggan')</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-on-surface-variant font-medium">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center">
                        <span class="text-sm font-bold text-on-primary-container">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mx-8 mt-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-lg">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-8 mt-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="material-symbols-outlined text-red-600 text-lg">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        <div class="p-8">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
