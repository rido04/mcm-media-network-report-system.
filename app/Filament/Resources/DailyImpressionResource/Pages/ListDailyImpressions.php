<?php

namespace App\Filament\Resources\DailyImpressionResource\Pages;

use App\Filament\Resources\DailyImpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyImpressions extends ListRecords
{
    protected static string $resource = DailyImpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Daily Impression'
            ),
        ];
    }
}
