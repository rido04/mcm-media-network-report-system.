<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Documentation;
use App\Models\MediaStatistic;
use App\Models\MediaPlacement;
use App\Models\PlayLog;

class DashboardTabsWidget extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-tabs-widget';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 16;

    public function getViewData(): array
    {
        return [
            'mediaPlacement' => MediaPlacement::latest()->get(),
            'mediaStatistics' => MediaStatistic::latest()->get(),
            'playLogs' => PlayLog::latest()->get(),
            'documentations' => Documentation::latest()->get(),
        ];
    }
}
