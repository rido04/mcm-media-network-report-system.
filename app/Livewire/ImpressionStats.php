<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaPlacement;
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

    $query = MediaPlacement::with(['adminTraffic', 'mediaStatistic'])
        ->whereHas('adminTraffic', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

    $result = $query->selectRaw('
        MAX(avg_daily_impression) as highest,
        MIN(avg_daily_impression) as lowest,
        AVG(avg_daily_impression) as average,
        SUM(avg_daily_impression) as total
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
