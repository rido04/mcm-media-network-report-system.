<?php

namespace App\Filament\Resources\AdPerformanceResource\Pages;

use App\Filament\Resources\AdPerformanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdPerformance extends EditRecord
{
    protected static string $resource = AdPerformanceResource::class;
    protected static ?string $title = 'Edit Storage';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
