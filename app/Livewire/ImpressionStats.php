<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ImpressionStats extends Component
{
    public $stats = [
        'highest' => 0,
        'lowest' => 0,
        'average' => 0,
        'total' => 0
    ];

    public $start_date = null;
    public $end_date = null;
    public $media_statistic_id = null;
    public $city = null;

    protected $listeners = [
        'refreshStatsWidget' => 'handleFiltersUpdated'
    ];

    public function mount()
    {
        $this->loadFilters();
        $this->stats = $this->getImpressionStats();
    }

    public function loadFilters()
    {
        $filters = session('filters', []);
        $this->start_date = $filters['start_date'] ?? null;
        $this->end_date = $filters['end_date'] ?? null;
        $this->media_statistic_id = $filters['media'] ?? null;
        $this->city = $filters['city'] ?? null;
    }

    public function handleFiltersUpdated($filters = null)
    {
        // If filters were passed directly, use them
        if ($filters) {
            // Validate the incoming filters
            $validated = $this->validateFilters($filters);

            $this->start_date = $validated['start_date'] ?? null;
            $this->end_date = $validated['end_date'] ?? null;
            $this->media_statistic_id = $validated['media'] ?? null;
            $this->city = $validated['city'] ?? null;
        } else {
            // Otherwise load from session (fallback)
            $this->loadFilters();
        }

        // Refresh stats and emit an event to trigger UI updates
        $this->stats = $this->getImpressionStats();
        $this->dispatch('statsUpdated');
    }

    protected function validateFilters(array $filters)
    {
        return validator($filters, [
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'media' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
        ])->validate();
    }

    public function refreshStats()
    {
        $this->stats = $this->getImpressionStats();
        $this->dispatch('statsUpdated');
    }

    public function getImpressionStats()
    {
        $userId = Auth::id();

        $query = DailyImpression::with(['adminTraffic', 'mediaStatistic']) // Eager loading
            ->whereHas('adminTraffic', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });

        // Date filters
        if ($this->start_date) {
            $query->whereDate('date', '>=', $this->start_date);
        }

        if ($this->end_date) {
            $query->whereDate('date', '<=', $this->end_date);
        }

        // Media filter
        if ($this->media_statistic_id && $this->media_statistic_id !== 'all') {
            $query->whereHas('mediaStatistic', function($q) {
                $q->where('media', $this->media_statistic_id)
                ->orWhere('id', $this->media_statistic_id);
            });
        }

        // City filter
        if ($this->city) {
            $query->whereHas('mediaStatistic', function($q) {
                $q->where('city', $this->city);
            });
        }

        // Use single query for all aggregation
        $result = $query->selectRaw('
            MAX(impression) as highest,
            MIN(impression) as lowest,
            AVG(impression) as average,
            SUM(impression) as total
        ')->first();

        return [
            'highest' => $result->highest ?? 0,
            'lowest' => $result->lowest ?? 0,
            'average' => $result->average ?? 0,
            'total' => $result->total ?? 0,
        ];
    }

    public function render()
    {
        return view('livewire.impression-stats');
    }
}
