<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GlobalFilterWidget extends Widget
{
    protected static string $view = 'filament.company.widgets.global-filter-widget';

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return true;
    }
}
