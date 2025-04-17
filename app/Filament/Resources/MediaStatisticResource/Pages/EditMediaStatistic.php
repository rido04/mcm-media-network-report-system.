<?php

namespace App\Filament\Resources\MediaStatisticResource\Pages;

use App\Filament\Resources\MediaStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaStatistic extends EditRecord
{
    protected static string $resource = MediaStatisticResource::class;
    protected static ?string $title = 'Edit Media Plan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
