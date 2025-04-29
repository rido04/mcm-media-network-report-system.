<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Livewire\CompanyDashboard;
use App\Livewire\Profile;

Route::get('/', function () {
    return redirect('login');
});

// DEFAULT LOGIN PAGE
Route::get('/login', function () {
    return view('auth.custom-login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Validate input first
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email address',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only(['email', 'password']);
    $remember = $request->filled('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect based on role
        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin');
        }

        if ($user->hasRole('company')) {
            return redirect()->intended('/company-dashboard');
        }

        // If role not recognized
        Auth::logout();
        return back()->withErrors([
            'email' => 'Your account does not have access permissions.'
        ]);
    }

    // If authentication fails
    return back()->withErrors([
        'email' => 'Invalid email or password',
    ])->withInput($request->only('email'));
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth', 'role:company'])->group(function () {
    Route::get('/company-dashboard', CompanyDashboard::class)->name('company.dashboard');
    Route::get('/profile', Profile::class)->name('profile');
});
