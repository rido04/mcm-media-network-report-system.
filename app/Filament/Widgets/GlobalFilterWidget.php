<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateRangePicker;

class GlobalFilterWidget extends Widget
{
    protected static string $view = 'filament.widgets.global-filter-widget';

    public $dateRange;
    public $mediaPlan;
    public $kota;
    public $mediaPlacement;

    public function mount()
    {
        $this->dateRange = session('filter_date_range');
        $this->mediaPlan = session('filter_media_plan');
        $this->kota = session('filter_kota');
        $this->mediaPlacement = session('filter_media_placement');
    }

    public function updated($property)
    {
        session([
            'filter_date_range' => $this->dateRange,
            'filter_media_plan' => $this->mediaPlan,
            'filter_kota' => $this->kota,
            'filter_media_placement' => $this->mediaPlacement,
        ]);

        $this->emit('filters-updated'); // Emit event untuk widget lain
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('filters.media_plan')
                ->label('Media Plan')
                ->options([
                    'DOOH' => 'DOOH',
                    'OOH' => 'OOH',
                    'Commuterline' => 'Commuterline',
                    'Bus' => 'Bus',
                    'Sosial Media' => 'Sosial Media',
                ])->placeholder('Pilih Media Plan'),
            TextInput::make('kota')->label('Kota'),
            TextInput::make('mediaPlacement')
                ->label('Media Placement')
                ->maxLength(10),
        ];
    }
}
