<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaPlacement;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TotalPerformance extends Component
{
    public $datasets = [];
    public $labels = "Total Performance";
    public $userId;

    public function mount()
    {
        // auth user_id
        $this->userId = Auth::id();
    }

    public function render()
{
    $data = MediaPlacement::select([
        'media',
        'avg_daily_impression as total',
    ])
    ->get();

    $mediaValues = $data->pluck('media')->unique()->values();
    $maxPoints = $data->groupBy('media')->map->count()->max(); // Max points for any media
    $labels = range(1, $maxPoints); // [1, 2, 3, ...]

    $colorPalette = [
        '#4F46E5', '#2563EB', '#7C3AED', '#DB2777', '#9333EA',
        '#10B981', '#F59E0B', '#EF4444', '#06B6D4', '#8B5CF6',
    ];

    $this->datasets = [];
    foreach ($mediaValues as $index => $media) {
        $colorIndex = $index % count($colorPalette);
        $color = $colorPalette[$colorIndex];
        $mediaData = $data->where('media', $media)->pluck('total')->values()->toArray();
        $this->datasets[] = [
            'label' => $media,
            'data' => array_pad($mediaData, $maxPoints, null),
            'backgroundColor' => $color,
            'borderColor' => $color,
            'borderWidth' => 1,
            'pointLabels' => array_pad(array_fill(0, count($mediaData), $media), $maxPoints, null),
        ];
    }

    $this->labels = $labels;

    return view('livewire.total-performance');
}
}
