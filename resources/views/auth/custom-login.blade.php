<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">
    <div class="login-box">
        <h2>MCM Portal</h2>
        <h4>Login</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
                <div class="bg-red-800 text-red-100 text-sm rounded px-4 py-2 mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="input-box">
                <input type="email" name="email" value="{{ old('email') }}" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>


            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    {{-- Animasi lingkaran --}}
    @for ($i = 0; $i < 50; $i++)
        <span style="--i:{{ $i }};"></span>
    @endfor
</div>

</body>
</html>
