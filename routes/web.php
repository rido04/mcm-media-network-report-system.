<?php

use Illuminate\Http\Request;
use App\Livewire\CompanyDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\DashboardController;

Route::get('/', function () {
    return redirect('login');
});

// DEFAULT LOGIN PAGE
Route::get('/login', function () {
    return view('auth.custom-login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Ambil kredensial dari request
    $credentials = $request->only(['email', 'password']); // Gunakan dependency injection

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Redirect sesuai role
        if ($user->hasRole('admin')) { // Ignore the hasRole Erro if shown up, cause VScode dont know if this is a Model
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

Route::post('/filament/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth', 'role:company'])->group(function () {
    Route::get('/company-dashboard', CompanyDashboard::class)->name('company.dashboard');
});
