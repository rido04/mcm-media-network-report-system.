<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $datasets = [];
    public $labels = [];
    public $userId;

    public function mount()
    {
        // auth user_id
        $this->userId = Auth::id();
    }

    public function render()
    {
        $data = DailyImpression::with('adminTraffic')
            ->join('admin_traffic', 'daily_impressions.admin_traffic_id', '=', 'admin_traffic.id')
            // Filter user_id
            ->where('admin_traffic.user_id', $this->userId)
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

        $colorPalette = [
            '#4F46E5', // Indigo-600
            '#2563EB', // Blue-600
            '#7C3AED', // Violet-600
            '#DB2777', // Pink-600
            '#9333EA', // Purple-600
            '#10B981', // Emerald-600
            '#F59E0B', // Amber-500
            '#EF4444', // Red-500
            '#06B6D4', // Cyan-500
            '#8B5CF6', // Purple-500
        ];

        $this->datasets = [];
            foreach ($categories as $index => $category) {
                // Choose colors from colorPalette avriable
                $colorIndex = $index % count($colorPalette);
                $color = $colorPalette[$colorIndex];

                $this->datasets[] = [
                    'label' => $category,
                    'data' => $dates->map(function ($date) use ($data, $category) {
                        return $data
                            ->where('date', $date)
                            ->where('category', $category)
                            ->sum('total');
                    })->toArray(),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'borderWidth' => 1,
                ];
            }

            $this->labels = $dates->map(fn ($date) => date('d M', strtotime($date)))->toArray();

            return view('livewire.profile' ,[
                'user' =>Auth::user()
            ]);
        }
}

