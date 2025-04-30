<!DOCTYPE html>
<html class="scroll-smooth">
<head>
    <title>@yield('title', 'MCM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    @livewireStyles()
    @stack('styles')
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Style untuk menu aktif */
        .nav-link.active {
            border-bottom: 2px solid #3b82f6;
        }

        /* Mobile dropdown style */
        .mobile-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-dropdown.open {
            max-height: 400px; /* Adjust based on your content */
        }
    </style>
</head>
<body class="bg-slate-950 text-gray-800">
    @php
        $user = auth()->user();
    @endphp
    @yield('content')
    @livewireScripts()
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.6.0/dist/countUp.umd.js"></script>
    @stack('scripts')
</body>
</html>
