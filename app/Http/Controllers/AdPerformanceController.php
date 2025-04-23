<?php

namespace App\Http\Controllers;

use App\Models\AdPerformance;
use App\Models\MediaStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdPerformanceController extends Controller
{
    public function showChart(Request $request)
    {
        // Get filter value
        $filter = $request->query('filter', 'all');

        // Get cities for filter dropdown
        $cities = MediaStatistic::where('user_id', Auth::id())
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->toArray();

        // Query
        $query = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
            ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()));

        // Add filter by city for current user
        if ($filter && $filter !== 'all') {
            $query->whereHas('mediaStatistic', function ($q) use ($filter) {
                $q->where('city', $filter);
            });
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

        $chartData = [
            'datasets' => [
                [
                    'label' => 'Used Placement',
                    'data' => $used,
                ],
                [
                    'label' => 'Available Placement',
                    'data' => $available,
                ],
            ],
            'labels' => $labels,
        ];

        return view('your-view-name', compact('chartData', 'cities', 'filter'));
    }


// In your existing controller method that renders the Blade file
public function yourExistingMethod(Request $request)
{
    // Your existing code here

    // Get filter value from request
    $filter = $request->query('filter', 'all');

    // Get cities for filter dropdown
    $cities = MediaStatistic::where('user_id', Auth::id())
        ->select('city')
        ->distinct()
        ->pluck('city')
        ->toArray();

    // Query
    $query = AdPerformance::with(['adminTraffic', 'mediaStatistic'])
        ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', Auth::id()));

    // Add filter by city for current user
    if ($filter && $filter !== 'all') {
        $query->whereHas('mediaStatistic', function ($q) use ($filter) {
            $q->where('city', $filter);
        });
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

    $chartData = [
        'datasets' => [
            [
                'label' => 'Used Placement',
                'data' => $used,
            ],
            [
                'label' => 'Available Placement',
                'data' => $available,
            ],
        ],
        'labels' => $labels,
    ];

    // Include these variables along with your existing data
    return view('your-existing-blade-file', compact(
        'chartData',
        'cities',
        'filter',
        // Your existing variables here...
    ));
}
}
