<?php

namespace App\Livewire;

use App\Models\PlayLog;
use Livewire\Component;
use App\Models\Documentation;
use App\Models\MediaPlacement;
use App\Models\MediaStatistic;
use Illuminate\Support\Facades\Auth;

class TabsSum extends Component
{
    public $mediaPlacement;
    public $mediaStatistics;
    public $playLogs;
    public $documentations;
    public function mount()
    {

        $userId = Auth::id();

        $this->mediaPlacement = MediaPlacement::where('user_id', $userId)->get();
        $this->mediaStatistics = MediaStatistic::where('user_id', $userId)->get();
        $this->playLogs = PlayLog::where('user_id', $userId)->get();
        $this->documentations = Documentation::where('user_id', $userId)->get();
    }
    public function render()
    {
        return view('livewire.tabs-sum');
    }
}
