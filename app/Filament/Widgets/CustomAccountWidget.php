<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class CustomAccountWidget extends Widget
{
    protected static string $view = 'filament.widgets.custom-account-widget';
    protected int | string | array $columnSpan = '50px';

    public function getUser()
    {
        return Auth::user();
    }
}
