<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Review') | CRM Mebel</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#442a22",
                        "background": "#f9f9f8",
                        "inverse-on-surface": "#f1f1f0",
                        "surface-dim": "#dadad9",
                        "tertiary-fixed": "#ece0dc",
                        "secondary-container": "#fadcd2",
                        "on-secondary-fixed-variant": "#56423b",
                        "outline-variant": "#d4c3be",
                        "primary-fixed": "#ffdbd0",
                        "surface-container-low": "#f4f4f3",
                        "surface-container": "#eeeeed",
                        "on-tertiary-container": "#bdb3af",
                        "tertiary-fixed-dim": "#cfc4c0",
                        "secondary": "#6f5a52",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#201a18",
                        "tertiary": "#352f2c",
                        "on-primary-fixed": "#2c160e",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed": "#271812",
                        "surface-container-high": "#e8e8e7",
                        "secondary-fixed-dim": "#ddc1b7",
                        "inverse-primary": "#e7bdb1",
                        "on-primary-container": "#d4ada1",
                        "surface-container-highest": "#e2e2e2",
                        "on-error": "#ffffff",
                        "primary-container": "#5d4037",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#4c4542",
                        "on-surface-variant": "#504441",
                        "on-background": "#1a1c1c",
                        "secondary-fixed": "#fadcd2",
                        "inverse-surface": "#2f3130",
                        "on-tertiary-fixed-variant": "#4c4542",
                        "primary-fixed-dim": "#e7bdb1",
                        "surface-variant": "#e2e2e2",
                        "surface": "#f9f9f8",
                        "on-surface": "#1a1c1c",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#f9f9f8",
                        "outline": "#827470",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#5d4037",
                        "surface-tint": "#77574d",
                        "on-secondary-container": "#766057",
                        "on-secondary": "#ffffff"
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
        body { font-family: 'Work Sans', sans-serif; }
        h1, h2, h3, .font-headline { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .wood-grain {
            background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAmzK92apjBWjoIKNs-53wwvhtJ7p2PA22U1AyFPlRhB7bJF5RNQmEvYmSMSIKPvqh7s3I3vHSYsk5_uTHBUWKntYYJ_-OrgcimFI8LQCSnjdOra0QMATqcG8bBvm2EmX-ENl4Fn1RlamLGwBEbMTmbCFNaKh2pG04ye47Lc-REg6b_gCOW__E4rT7nbuBnKEySJnwFkp5H8AGyrEHHTu6vJL3p51vwx9c1up4nAC4zKXum4ROqSYSiIidNNNdSVsGNQzk3rxCXTQ_c');
        }
        .rating-input {
            display: none;
        }
        .rating-label {
            cursor: pointer;
            transition: transform 0.15s ease;
        }
        .rating-label:hover {
            transform: scale(1.15);
        }
        .rating-label svg {
            transition: color 0.15s ease;
        }
    </style>
    @yield('head')
</head>
<body class="bg-background text-on-surface min-h-screen">
    @yield('content')
    @stack('scripts')
</body>
</html>
