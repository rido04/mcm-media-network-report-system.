<?php

namespace App\Filament\Company\Resources\MediaStatisticResource\Pages;

use App\Filament\Widgets\MediaStatisticFilterWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Company\Widgets\MediaStatisticOverview;
use App\Filament\Company\Resources\MediaStatisticResource;

class ListMediaStatistics extends ListRecords
{
    protected static string $resource = MediaStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            MediaStatisticOverview::class,
        ];
    }
}
