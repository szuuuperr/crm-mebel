<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title> Web CRM Produk Mebel | @yield('title', 'Dashboard')</title>
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
        .glass-pill {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        .glass-overlay {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d4c3be; border-radius: 10px; }
        .wood-grain-overlay {
            background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAmzK92apjBWjoIKNs-53wwvhtJ7p2PA22U1AyFPlRhB7bJF5RNQmEvYmSMSIKPvqh7s3I3vHSYsk5_uTHBUWKntYYJ_-OrgcimFI8LQCSnjdOra0QMATqcG8bBvm2EmX-ENl4Fn1RlamLGwBEbMTmbCFNaKh2pG04ye47Lc-REg6b_gCOW__E4rT7nbuBnKEySJnwFkp5H8AGyrEHHTu6vJL3p51vwx9c1up4nAC4zKXum4ROqSYSiIidNNNdSVsGNQzk3rxCXTQ_c');
            opacity: 0.03;
        }
    </style>
    @yield('head')
</head>
<body class="bg-surface text-on-surface min-h-screen @yield('body-class')">

    {{-- Sidebar Component --}}
    <div id="app-sidebar" class="transition-all duration-200">
        <x-sidebar :activePage="$activePage ?? 'dashboard'" />
    </div>

    {{-- Main Content Area --}}
    <main id="app-main" class="ml-72 min-h-screen transition-all duration-200">
        {{-- Navbar Component --}}
        <div id="app-navbar" class="transition-all duration-200">
            <x-navbar :unreadNotifications="$unreadNotifications ?? 0" />
        </div>

        {{-- Page Content --}}
        @yield('content')
    </main>

    {{-- Optional FAB --}}
    @yield('fab')

    {{-- Modals (rendered at body root level so backdrop covers sidebar + navbar) --}}
    @yield('modals')

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
            document.getElementById('app-sidebar').classList.add('blur-sm', 'pointer-events-none');
            document.getElementById('app-navbar').classList.add('blur-sm', 'pointer-events-none');
            document.getElementById('app-main').classList.add('blur-sm', 'pointer-events-none');
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            document.getElementById('app-sidebar').classList.remove('blur-sm', 'pointer-events-none');
            document.getElementById('app-navbar').classList.remove('blur-sm', 'pointer-events-none');
            document.getElementById('app-main').classList.remove('blur-sm', 'pointer-events-none');
        }

        // Live Search
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsContent = document.getElementById('searchResultsContent');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch(`/search?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            let html = '';
                            let hasResults = false;

                            if (data.projects && data.projects.length > 0) {
                                hasResults = true;
                                html += '<p class="text-xs font-bold text-outline uppercase tracking-wider mb-2">Proyek</p>';
                                data.projects.forEach(p => {
                                    html += `<a href="/projects/${p.id}/track" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container transition-colors mb-1">
                                        <span class="material-symbols-outlined text-primary text-sm">handyman</span>
                                        <div><p class="text-sm font-medium text-on-surface">${p.nama}</p>
                                        <p class="text-xs text-on-surface-variant">${p.customer ? p.customer.nama : '-'}</p></div></a>`;
                                });
                            }

                            if (data.products && data.products.length > 0) {
                                hasResults = true;
                                html += '<p class="text-xs font-bold text-outline uppercase tracking-wider mb-2 mt-3">Produk</p>';
                                data.products.forEach(p => {
                                    html += `<a href="/products/${p.id}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container transition-colors mb-1">
                                        <span class="material-symbols-outlined text-primary text-sm">chair</span>
                                        <div><p class="text-sm font-medium text-on-surface">${p.nama_produk}</p>
                                        <p class="text-xs text-on-surface-variant">Rp ${Number(p.harga).toLocaleString('id-ID')}</p></div></a>`;
                                });
                            }

                            if (data.customers && data.customers.length > 0) {
                                hasResults = true;
                                html += '<p class="text-xs font-bold text-outline uppercase tracking-wider mb-2 mt-3">Pelanggan</p>';
                                data.customers.forEach(c => {
                                    html += `<a href="/clients/${c.id}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container transition-colors mb-1">
                                        <span class="material-symbols-outlined text-primary text-sm">person</span>
                                        <div><p class="text-sm font-medium text-on-surface">${c.nama}</p>
                                        <p class="text-xs text-on-surface-variant">${c.perusahaan || c.email || '-'}</p></div></a>`;
                                });
                            }

                            if (data.orders && data.orders.length > 0) {
                                hasResults = true;
                                html += '<p class="text-xs font-bold text-outline uppercase tracking-wider mb-2 mt-3">Pesanan</p>';
                                data.orders.forEach(o => {
                                    html += `<a href="/sales/${o.id}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-container transition-colors mb-1">
                                        <span class="material-symbols-outlined text-primary text-sm">receipt_long</span>
                                        <div><p class="text-sm font-medium text-on-surface">${o.nomor_faktur}</p>
                                        <p class="text-xs text-on-surface-variant">${o.customer ? o.customer.nama : '-'}</p></div></a>`;
                                });
                            }

                            if (!hasResults) {
                                html = '<p class="text-sm text-on-surface-variant text-center py-4">Tidak ada hasil ditemukan.</p>';
                            }

                            searchResultsContent.innerHTML = html;
                            searchResults.classList.remove('hidden');
                        })
                        .catch(() => {
                            searchResultsContent.innerHTML = '<p class="text-sm text-error text-center py-4">Terjadi kesalahan.</p>';
                            searchResults.classList.remove('hidden');
                        });
                }, 300);
            });

            document.addEventListener('click', function(e) {
                if (!searchResults.contains(e.target) && e.target !== searchInput) {
                    searchResults.classList.add('hidden');
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
