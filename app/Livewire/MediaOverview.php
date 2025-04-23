<?php

namespace App\Livewire;

use App\Models\MediaStatistic;
use Livewire\Component;
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
        // Use filters from parameter or session
        if (!$filters) {
            $filters = session('filters', [
                'start_date' => null,
                'end_date' => null,
                'media' => null,
                'city' => null,
            ]);
        }

        // Start with base query
        $query = MediaStatistic::where('user_id', Auth::id());

        // Apply filters
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

        // Calculate statistics
        $this->stats['totalMediaPlan'] = $query->distinct('media')->count('media');
        $this->stats['totalInventory'] = $query->count();

        // Calculate total duration (in days)
        $totalDays = 0;
        $remainingDays = 0;
        $today = now()->startOfDay();

        $stats = $query->get();
        foreach ($stats as $stat) {
            $startDate = \Carbon\Carbon::parse($stat->start_date);
            $endDate = \Carbon\Carbon::parse($stat->end_date);

            // Calculate total duration
            $duration = $startDate->diffInDays($endDate) + 1; // +1 to include end day
            $totalDays += $duration;

            // Calculate remaining days
            if ($endDate->gt($today)) {
                $remaining = $today->diffInDays($endDate);
                $remainingDays += $remaining;
            }
        }

        $this->stats['totalDuration'] = $totalDays;
        $this->stats['remainingDays'] = $remainingDays;

        // Dispatch event to refresh filter component if needed
        $this->dispatch('filtersUpdated', $filters);
    }

    public function render()
    {
        return view('livewire.media-overview');
    }
}
