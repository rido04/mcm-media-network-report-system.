<?php

namespace App\Livewire;

use App\Models\AdMedia;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdDisplay extends Component
{

    public $records = [];

    public function mount()
    {
        // Fetch records from the database
        $this->records = AdMedia::where('user_id', Auth::id())
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        // Debugging missing image paths
        foreach ($this->records as $record) {
            if (!Storage::exists($record->image_path)) {
                logger()->warning("Image not found: {$record->image_path}");
            }
        }
    }
    public function render()
    {
        return view('livewire.ad-display' ,[
            'records' => $this->records
        ]);
    }
}
