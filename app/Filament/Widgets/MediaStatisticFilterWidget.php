<?php

namespace App\Filament\Widgets;

use App\Models\MediaStatistic;
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

    protected static ?int $sort = 1;
    public $filters = [
        'start_date' => null,
        'end_date' => null,
        'media' => null,
        'city' => null,
    ];

    public function applyFilters()
    {
        $this->filters = $this->form->getState(); // Ambil data dari form
        session([
            'filters' => $this->filters,
        ]);

        $this->dispatch('refreshStatsWidget');
    }

    protected function getFormSchema(): array
    {
        return [
        DatePicker::make('filters.start_date')
            ->label('Tanggal Mulai'),

        DatePicker::make('filters.end_date')
            ->label('Tanggal Selesai'),

            Select::make('filters.media')
            ->label('Media Plan')
            ->placeholder('Media Plan')
            ->options(fn () => MediaStatistic::query()
            ->select('media')
            ->distinct()
            ->pluck('media', 'media')),

        Select::make('filters.city')
            ->label('Kota')
            ->placeholder('Pilih Kota')
            ->options(fn () => MediaStatistic::query()
            ->select('city')
            ->distinct()
            ->pluck('city', 'city')),
    ];
    }

    public function mount(): void
        {
        $this->form->fill(
            $this->filters = session('filters', [])
        );
        }

}
