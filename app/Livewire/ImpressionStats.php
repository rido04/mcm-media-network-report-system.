<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyImpression;
use Illuminate\Support\Facades\Auth;

class ImpressionStats extends Component
{
    public $start_date;
    public $end_date;
    public $media_statistic_id;

    // Membuat event listener untuk refresh widget
    protected $listeners = ['refreshStatsWidget' => '$refresh'];

    public function mount()
    {
        // Ambil filter dari session (jika ada)
        $filters = session('filters', []);
        $this->start_date = $filters['start_date'] ?? null;
        $this->end_date = $filters['end_date'] ?? null;
        $this->media_statistic_id = $filters['media_statistic_id'] ?? 'all';
    }

    // Mendapatkan data berdasarkan filter
    public function getImpressionStats()
    {
        $userId = Auth::id();

        $query = DailyImpression::whereHas('adminTraffic', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
        
        if (!empty($this->start_date)) {
            $query->whereDate('date', '>=', $this->start_date);
        }

        if (!empty($this->end_date)) {
            $query->whereDate('date', '<=', $this->end_date);
        }

        if ($this->media_statistic_id !== 'all') {
            $query->where('media_statistic_id', $this->media_statistic_id);
        }

        return [
            'highest' => $query->max('impression'),
            'lowest' => $query->min('impression'),
            'average' => $query->avg('impression'),
            'total' => $query->sum('impression'),
        ];
    }

    public function render()
    {
        $stats = $this->getImpressionStats();

        return view('livewire.impression-stats', compact('stats'));
    }
}
