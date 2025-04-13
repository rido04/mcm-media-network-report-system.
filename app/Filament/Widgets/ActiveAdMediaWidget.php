<?php

namespace App\Filament\Widgets;

use App\Models\AdMedia;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActiveAdMediaWidget extends Widget
{
    protected static string $view = 'filament.widgets.active-ad-media-widget';
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full'; // Pastikan full width

    public function getRecords()
    {
        $records = AdMedia::where('user_id', Auth::id())
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        // Debugging
        foreach ($records as $record) {
            if (!Storage::exists($record->image_path)) {
                logger()->warning("Image not found: {$record->image_path}");
            }
        }

        return $records;
    }
}
