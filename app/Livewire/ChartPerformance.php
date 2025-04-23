<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\AdPerformance;
use Illuminate\Support\Facades\Auth;

class ChartPerformance extends Component
{
    public $chartFilter = 'all'; // Untuk filter chart berdasarkan kota

    public function updatedChartFilter()
    {
        $this->dispatch('refreshChart', $this->chartData);
    }
    public function getChartDataProperty()
    {
        $query = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
            ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()));

        if ($this->chartFilter !== 'all') {
            $query->whereHas('mediaStatistic', fn ($q) => $q->where('city', $this->chartFilter));
        }

        $data = $query->get()
            ->groupBy(fn ($item) => $item->adminTraffic->category ?? 'Unknown');

        $labels = [];
        $used = [];
        $available = [];

        foreach ($data as $category => $items) {
            $labels[] = $category;
            $used[] = $items->sum('used_placement');
            $available[] = $items->sum('available_placement');
        }

        return [
            'labels' =>  $labels,
            'datasets' => [
                [
                    'label' => 'Used Placement',
                    'data' => $used,
                    'textColor' => '#FFFFFF',
                    'backgroundColor' => '#9BD0F5',
                    'borderRadius' => 4,
                    'barThickness' => 30,
                ],
                [
                    'label' => 'Available Placement',
                    'data' => $available,
                    'textColor' => '#FFFFFF',
                    'backgroundColor' => '#F7B267',
                    'borderRadius' => 4,
                    'barThickness' => 30,
                ],
            ],
        ];
    }
    public function render()
    {
        return view('livewire.chart-performance', ['chartData' => $this->chartData]);
    }
}
