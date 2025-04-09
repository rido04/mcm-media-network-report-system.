<?php

namespace App\Filament\Widgets;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Widgets\Widget;

class MediaStatisticFilterWidget extends Widget
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.media-statistic-filter-widget';

    public $filters = [
        'date_range' => null,
        'media_plan' => null,
        'kota' => null,
        'media_placement' => null,
    ];

    public function applyFilters()
    {
        $this->emit('applyFilters', $this->filters);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('date_range')->label('Range Tanggal'),
            Forms\Components\Select::make('media_plan')
                ->label('Media Plan')
                ->options([
                    'DOOH' => 'DOOH',
                    'OOH' => 'OOH',
                    'Commuterline' => 'Commuterline',
                    'Bus' => 'Bus',
                    'Sosial Media' => 'Sosial Media',
                ])
                ->placeholder('Pilih Media Plan'),
            Forms\Components\TextInput::make('kota')->label('Kota'),
            Forms\Components\TextInput::make('media_placement')
                ->label('Media Placement')
                ->maxLength(10),
        ];
    }
}
