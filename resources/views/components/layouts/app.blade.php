<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Kalau pakai Vite --}}
    @livewireStyles
</head>
<body class="bg-slate-950 text-gray-800">
    {{ $slot }}

    @livewireScripts
    @stack('scripts')
</body>
</html>
