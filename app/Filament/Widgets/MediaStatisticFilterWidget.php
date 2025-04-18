<?php

namespace App\Filament\Widgets;

use Filament\Forms;
use Filament\Widgets\Widget;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
        $query = MediaStatistic::query()
          ->where('user_id', Auth::id()); // get user id

        if ($this->filters['start_date']) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if ($this->filters['end_date']) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return [
        DatePicker::make('filters.start_date')
            ->label('Start Date'),

        DatePicker::make('filters.end_date')
            ->label('End Date'),

        Select::make('filters.media')
            ->label('Media Plan')
            ->placeholder('Media Plan')
            ->options(fn () => MediaStatistic::query()
            ->where('user_id', Auth::id()) // get auth user id
            ->select('media')
            ->distinct()
            ->pluck('media', 'media')),

        Select::make('filters.city')
            ->label('City')
            ->placeholder('City')
            ->options(fn () => MediaStatistic::query()
            ->where('user_id', Auth::id())
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
