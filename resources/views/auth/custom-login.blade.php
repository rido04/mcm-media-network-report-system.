<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form method="POST" action="/login" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl mb-4 font-bold">Login</h2>

        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">
            Login
        </button>
    </form>
</body>
</html>
