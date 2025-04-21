<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ImpressionStatsCustom extends Widget
{
    protected static string $view = 'filament.widgets.impression-stats-custom';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $maxHeight = null;

    protected $listeners = ['refreshStatsWidget' => '$refresh'];
}
