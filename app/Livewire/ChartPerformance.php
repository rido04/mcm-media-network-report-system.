<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\AdPerformance;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Auth;

class ChartPerformance extends Component
{
    public $filter = 'all'; // for city filter
    public $cities = [];
    protected $listeners = ['refreshChart' => '$refresh'];
    public function mount()
    {
        $this->cities = MediaStatistic::where('user_id', Auth::id())
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->toArray();
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'filter') {
            $this->dispatch('refreshChart');
        }
    }
    public function getChartDataProperty()
{
    $data = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
        ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()))
        ->get()
        ->groupBy(fn ($item) => $item->adminTraffic->category ?? 'Unknown');

    $labels = [];
    $used = [];
    $available = [];
    $cityMap = []; // Simpan city info

    foreach ($data as $category => $items) {
        $labels[] = $category;
        $used[] = $items->sum('used_placement');
        $available[] = $items->sum('available_placement');

        // Ambil nama kota dominan (atau pertama) untuk tooltip
        $cityMap[] = $items->first()?->mediaStatistic->city ?? 'Unknown';
    }

    return [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Used Placement',
                'data' => $used,
                'city' => $cityMap,
                'backgroundColor' => '#ff4d4d',
                'borderRadius' => 4,
                'barThickness' => 30,
            ],
            [
                'label' => 'Available Placement',
                'data' => $available,
                'city' => $cityMap,
                'backgroundColor' => 'blue',
                'borderRadius' => 4,
                'barThickness' => 30,
            ],
        ],
    ];
}


    public function render()
    {
        return view('livewire.chart-performance', [
            'chartData' => $this->chartData,
            'filterOptions' => array_merge(['all' => 'All Cities'], array_combine($this->cities, $this->cities))
        ]);
    }
}
