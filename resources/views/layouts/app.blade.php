<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'MCM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    @yield('content')
</body>
</html>
