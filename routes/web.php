<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.custom-login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Ambil kredensial dari request
    $credentials = $request->only(['email', 'password']); // Gunakan dependency injection

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Redirect sesuai role
        if ($user->hasRole('admin')) { // Perbaiki pemanggilan hasRole
            return redirect()->intended('/admin');
        }

        if ($user->hasRole('company')) { // Perbaiki pemanggilan hasRole
            return redirect()->intended('/company');
        }

        // Jika role tidak dikenali
        Auth::logout();
        return back()->withErrors(['email' => 'Role tidak dikenal.']);
    }

    // Jika login gagal
    return back()->withErrors([
        'email' => 'Login gagal.',
    ]);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
