<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\DB;

class TotalPerformance extends Component
{
    public $datasets = [];
    public $labels = [];

    public function render()
    {
        $data = DailyImpression::with('adminTraffic')
            ->join('admin_traffic', 'daily_impressions.admin_traffic_id', '=', 'admin_traffic.id')
            ->select([
                DB::raw('DATE(daily_impressions.date) as date'),
                'admin_traffic.category',
                DB::raw('SUM(daily_impressions.impression) as total'),
            ])
            ->groupBy('date', 'admin_traffic.category')
            ->orderBy('date')
            ->get();

        $categories = $data->pluck('category')->unique()->values();
        $dates = $data->pluck('date')->unique()->sort()->values();

        $this->datasets = [];
        foreach ($categories as $category) {
            $this->datasets[] = [
                'label' => $category,
                'data' => $dates->map(function ($date) use ($data, $category) {
                    return $data
                        ->where('date', $date)
                        ->where('category', $category)
                        ->sum('total');
                })->toArray(),
                'backgroundColor' => '#' . substr(md5($category), 0, 6),
                'borderColor' => '#' . substr(md5($category), 0, 6),
                'borderWidth' => 1,
            ];
        }

        $this->labels = $dates->map(fn ($date) => date('d M', strtotime($date)))->toArray();

        return view('livewire.total-performance');
    }
}
