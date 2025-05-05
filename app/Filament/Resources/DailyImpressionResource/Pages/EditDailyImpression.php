<?php

namespace App\Filament\Resources\DailyImpressionResource\Pages;

use App\Filament\Resources\DailyImpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyImpression extends EditRecord
{
    protected static string $resource = DailyImpressionResource::class;
    protected static ?string $title = 'Edit Impression';
    protected function getRedirectUrl(): string
    {
        // redirect after input users
        return $this->getResource()::getUrl('index');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
