<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MediaOverview extends Component
{
    public $stats = [
        'totalMediaPlan' => 0,
        'totalInventory' => 0,
        'totalDuration' => 0,
        'remainingDays' => 0,
    ];

    // Listen for the filter refresh event
    protected $listeners = ['refreshStatsWidget' => 'refreshStats'];

    public function mount()
    {
        $this->refreshStats();
    }

    public function refreshStats($filters = null)
    {
        $filters = $this->resolveFilters($filters);

        $cacheKey = 'media_overview_'.Auth::id().'_'.md5(json_encode($filters));

        $this->stats = cache()->remember($cacheKey, now()->addMinutes(30), function() use ($filters) {
            $query = $this->buildBaseQuery($filters);

            $stats = $query->get([
                'start_date',
                'end_date',
                DB::raw('DATEDIFF(end_date, start_date) + 1 as duration_days')
            ]);

            $today = now()->startOfDay();
            $totalDays = 0;
            $remainingDays = 0;

            foreach ($stats as $stat) {
                $totalDays += $stat->duration_days;
                $endDate = \Carbon\Carbon::parse($stat->end_date);

                if ($endDate->gt($today)) {
                    $remainingDays += $today->diffInDays($endDate);
                }
            }

            return [
                'totalMediaPlan' => $query->distinct('media')->count('media'),
                'totalInventory' => $query->count(),
                'totalDuration' => $totalDays,
                'remainingDays' => $remainingDays
            ];
        });

        $this->dispatch('stats-updated-init', ['stats' => $this->stats]);
    }

    protected function resolveFilters($filters)
    {
        return $filters ?: session('filters', [
            'start_date' => now()->startOfYear()->format('Y-m-d'),
            'end_date' => now()->endOfYear()->format('Y-m-d'),
            'media' => null,
            'city' => null,
        ]);
    }

    protected function buildBaseQuery($filters)
    {
        $query = MediaStatistic::where('user_id', Auth::id());

        if (!empty($filters['start_date'])) {
            $query->where('start_date', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->where('end_date', '<=', $filters['end_date']);
        }

        if (!empty($filters['media'])) {
            $query->where('media', $filters['media']);
        }

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        return $query;
    }
    public function render()
    {
        return view('livewire.media-overview');
    }
}
