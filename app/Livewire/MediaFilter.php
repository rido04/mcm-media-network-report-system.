<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Auth;

class MediaFilter extends Component
{
    public $filters = [
        'start_date' => null,
        'end_date' => null,
        'media' => null,
        'city' => null,
    ];

    public $mediaOptions = [];
    public $cityOptions = [];

    public function mount()
    {
        // Default date values
        // if (!$this->filters['start_date']) {
        //     $this->filters['start_date'] = now()->startOfYear()->format('Y-m-d');
        // }

        // if (!$this->filters['end_date']) {
        //     $this->filters['end_date'] = now()->endOfYear()->format('Y-m-d');
        // }

        // Load from session if available
        $sessionFilters = session('filters');
        if ($sessionFilters) {
            $this->filters = $sessionFilters;
        }

        // Load options for dropdowns
        $this->loadOptions();
    }

    public function loadOptions()
    {
        // Get media options from database
        $this->mediaOptions = MediaStatistic::query()
            ->where('user_id', Auth::id())
            ->select('media')
            ->distinct()
            ->pluck('media', 'media')
            ->toArray();

        // Get city options from database
        $this->cityOptions = MediaStatistic::query()
            ->where('user_id', Auth::id())
            ->select('city')
            ->distinct()
            ->pluck('city', 'city')
            ->toArray();
    }

    public function applyFilters()
    {
        // 1. Store in session for persistence
        session(['filters' => $this->filters]);

        // 2. Dispatch event to refresh stats widget
        $this->dispatch('refreshStatsWidget', $this->filters);
    }

    public function resetFilters()
    {
        $this->filters = [
            'start_date' => now()->startOfYear()->format('Y-m-d'),
            'end_date' => now()->endOfYear()->format('Y-m-d'),
            'media' => null,
            'city' => null,
        ];

        // 1. Update session
        session(['filters' => $this->filters]);

        // 2. Dispatch event
        $this->dispatch('refreshStatsWidget', $this->filters);
    }

    public function clearDateFilter()
    {
        $this->filters['start_date'] = now()->startOfYear()->format('Y-m-d');
        $this->filters['end_date'] = now()->endOfYear()->format('Y-m-d');

        session(['filters' => $this->filters]);
        $this->dispatch('refreshStatsWidget', $this->filters);
    }

    public function clearMediaFilter()
    {
        $this->filters['media'] = null;

        session(['filters' => $this->filters]);
        $this->dispatch('refreshStatsWidget', $this->filters);
    }

    public function clearCityFilter()
    {
        $this->filters['city'] = null;

        session(['filters' => $this->filters]);
        $this->dispatch('refreshStatsWidget', $this->filters);
    }

    public function render()
    {
        return view('livewire.media-filter');
    }
}
