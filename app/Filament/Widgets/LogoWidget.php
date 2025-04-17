<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class LogoWidget extends Widget
{
    protected static string $view = 'filament.widgets.logo-widget';

    protected int | string | array $columnSpan = '50px'; // Agar memenuhi lebar

    public static function canView(): bool
    {
        return Auth::check(); // Hanya tampilkan jika user login
    }
}
