<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaStatistic;
use App\Models\AdPerformance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CompanyDashboard extends Component
{
    // public $filters = [
    //     'start_date' => null,
    //     'end_date' => null,
    //     'media' => null,
    //     'city' => null,
    // ];

    // public $chartFilter = 'all'; // Untuk filter chart berdasarkan kota

    // public function mount()
    // {
    //     $this->filters = session('filters', $this->filters);
    // }

    // public function applyFilters()
    // {
    //     session(['filters' => $this->filters]);
    //     $this->dispatch('refreshStatsWidget');
    // }

    public function updatedChartFilter()
    {
        $this->dispatch('refreshChart', $this->chartData);
    }

    public function getTestProperty()
    {
        return 42;
    }

    // public function getStatsProperty()
    // {
    //     $user = Auth::user();
    //     $filters = session('filters', $this->filters);

    //     $mediaStats = MediaStatistic::where('user_id', $user->id)
    //         ->when($filters['start_date'] ?? null, fn($q, $val) => $q->whereDate('start_date', '>=', $val))
    //         ->when($filters['end_date'] ?? null, fn($q, $val) => $q->whereDate('end_date', '<=', $val))
    //         ->when($filters['media'] ?? null, fn($q, $val) => $q->where('media', $val))
    //         ->when($filters['city'] ?? null, fn($q, $val) => $q->where('city', 'like', "%$val%"))
    //         ->get();

    //     $totalMediaPlan = $mediaStats->count();
    //     $totalInventory = $mediaStats->pluck('media_placement')->count();

    //     $totalDuration = $mediaStats->reduce(function ($carry, $item) {
    //         $start = Carbon::parse($item->start_date);
    //         $end = Carbon::parse($item->end_date);
    //         return $carry + $start->diffInDays($end);
    //     }, 0);

    //     $remainingDays = $mediaStats->reduce(function ($carry, $item) {
    //         $now = now();
    //         $end = Carbon::parse($item->end_date);
    //         if ($now->lessThanOrEqualTo($end)) {
    //             $carry += floor($now->diffInDays($end));
    //         }
    //         return $carry;
    //     }, 0);

    //     return [
    //         'totalMediaPlan' => $totalMediaPlan,
    //         'totalInventory' => $totalInventory,
    //         'totalDuration' => $totalDuration,
    //         'remainingDays' => $remainingDays,
    //     ];
    // }

    // function for availabi
    // public function getChartDataProperty()
    // {
    //     $query = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
    //         ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()));

    //     if ($this->chartFilter !== 'all') {
    //         $query->whereHas('mediaStatistic', fn ($q) => $q->where('city', $this->chartFilter));
    //     }

    //     $data = $query->get()
    //         ->groupBy(fn ($item) => $item->adminTraffic->category ?? 'Unknown');

    //     $labels = [];
    //     $used = [];
    //     $available = [];

    //     foreach ($data as $category => $items) {
    //         $labels[] = $category;
    //         $used[] = $items->sum('used_placement');
    //         $available[] = $items->sum('available_placement');
    //     }

    //     return [
    //         'labels' =>  $labels,
    //         'datasets' => [
    //             [
    //                 'label' => 'Used Placement',
    //                 'data' => $used,
    //                 'textColor' => '#FFFFFF',
    //                 'backgroundColor' => '#9BD0F5',
    //                 'borderRadius' => 4,
    //                 'barThickness' => 30,
    //             ],
    //             [
    //                 'label' => 'Available Placement',
    //                 'data' => $available,
    //                 'textColor' => '#FFFFFF',
    //                 'backgroundColor' => '#F7B267',
    //                 'borderRadius' => 4,
    //                 'barThickness' => 30,
    //             ],
    //         ],
    //     ];
    // }

    public function render()
    {
        return view('livewire.company-dashboard');

    }
}
