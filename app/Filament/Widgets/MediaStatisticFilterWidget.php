<?php

namespace App\Filament\Widgets;

use Filament\Forms;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class MediaStatisticFilterWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.media-statistic-filter-widget';

    public $filters = [
        'start_date' => null,
        'end_date' => null,
        'media_plan' => null,
        'city' => null,
        'media_placement' => null,
    ];

    public function applyFilters()
    {
        $this->filters = $this->form->getState(); // Ambil data dari form
        session([
            'filters' => $this->filters,
        ]);

        $this->dispatch('refreshStatsWidget');
        Log::info('Filters applied', $this->filters);
    }

    protected function getFormSchema(): array
    {
        return [
        DatePicker::make('filters.start_date')
            ->label('Tanggal Mulai'),

        DatePicker::make('filters.end_date')
            ->label('Tanggal Selesai'),

        Select::make('filters.media_plan')
            ->label('Media Plan')
            ->options([
                'DOOH' => 'DOOH',
                'OOH' => 'OOH',
                'Commuterline' => 'Commuterline',
                'Bus' => 'Bus',
                'Sosial Media' => 'Sosial Media',
            ])
            ->placeholder('Pilih Media Plan'),

        Forms\Components\TextInput::make('filters.city')
            ->label('Kota')
            ->placeholder('Masukkan nama kota'),

        Forms\Components\TextInput::make('filters.media_placement')
            ->label('Media Placement')
            ->maxLength(10)
            ->placeholder('Maks. 10 karakter'),
    ];
    }

    public function mount(): void
        {
        $this->form->fill(
            $this->filters = session('filters', [])
        );
        }

}
