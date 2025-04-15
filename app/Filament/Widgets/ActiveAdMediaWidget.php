<?php

namespace App\Filament\Widgets;

use App\Models\AdMedia;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Filament\Support\Facades\FilamentAsset;

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
    protected function getViewData(): array
    {
        return [
            'records' => $this->getRecords()
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        FilamentAsset::register([
            $this->makeAsset('style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'),
            $this->makeAsset('style', asset('css/filament/swiper.css')),
            $this->makeAsset('style', asset('../resources/css/filament/swiper.css')),
            $this->makeAsset('script', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js'),
        ]);
    }
    
    private function makeAsset(string $type, string $path): mixed
    {
        return $type === 'style' 
            ? FilamentAsset::style(md5($path), $path)
            : FilamentAsset::script(md5($path), $path);
    }
}
