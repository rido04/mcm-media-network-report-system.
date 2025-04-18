<?php

namespace App\Filament\Widgets;

use App\Models\PlayLog;
use Filament\Widgets\Widget;
use App\Models\Documentation;
use App\Models\MediaPlacement;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Auth;

class DashboardTabsWidget extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-tabs-widget';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 16;


    public function getViewData(): array
    {
        $user = Auth::id(); // Get the authenticated user's ID
        return [
            'mediaPlacement' => MediaPlacement::where('user_id', $user)->get(),
            'mediaStatistics' => MediaStatistic::where('user_id', $user)->get(),
            'playLogs' => PlayLog::where('user_id', $user)->get(),
            'documentations' => Documentation::where('user_id', $user)->get(),
        ];
    }
}
