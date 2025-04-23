<?php

namespace App\Livewire;

use Livewire\Component;

class MediaFilter extends Component
{
    public $filters = [
        'start_date' => null,
        'end_date' => null,
        'media' => null,
        'city' => null,
    ];


    public function mount()
    {
        $this->filters = session('filters', $this->filters);
    }

    public function applyFilters()
    {
        session(['filters' => $this->filters]);
        $this->dispatch('refreshStatsWidget');
    }



    public function render()
    {
        return view('livewire.media-filter');
    }
}
