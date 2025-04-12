<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentColor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::registerRenderHook(
            'panels::auth.logout.after',
            fn () => view('custom.logout-script')
        );

        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Amber,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }
}
