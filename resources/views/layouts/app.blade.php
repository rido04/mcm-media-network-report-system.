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
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 scroll-smooth">
    @yield('content')
    @livewireScripts()
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.6.0/dist/countUp.umd.js"></script>
    @stack('scripts')
</body>
</html>
