<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaStatistic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MediaOverview extends Component
{
    public function getStatsProperty()
    {
        $user = Auth::user();
        $filters = session('filters');

        $mediaStats = MediaStatistic::where('user_id', $user->id)
            ->when($filters['start_date'] ?? null, fn($q, $val) => $q->whereDate('start_date', '>=', $val))
            ->when($filters['end_date'] ?? null, fn($q, $val) => $q->whereDate('end_date', '<=', $val))
            ->when($filters['media'] ?? null, fn($q, $val) => $q->where('media', $val))
            ->when($filters['city'] ?? null, fn($q, $val) => $q->where('city', 'like', "%$val%"))
            ->get();

        $totalMediaPlan = $mediaStats->count();
        $totalInventory = $mediaStats->pluck('media_placement')->count();

        $totalDuration = $mediaStats->reduce(function ($carry, $item) {
            $start = Carbon::parse($item->start_date);
            $end = Carbon::parse($item->end_date);
            return $carry + $start->diffInDays($end);
        }, 0);

        $remainingDays = $mediaStats->reduce(function ($carry, $item) {
            $now = now();
            $end = Carbon::parse($item->end_date);
            if ($now->lessThanOrEqualTo($end)) {
                $carry += floor($now->diffInDays($end));
            }
            return $carry;
        }, 0);

        return [
            'totalMediaPlan' => $totalMediaPlan,
            'totalInventory' => $totalInventory,
            'totalDuration' => $totalDuration,
            'remainingDays' => $remainingDays,
        ];
    }

    public function render()
    {
        return view('livewire.media-overview', ['stats' => $this->stats]);
    }
}
