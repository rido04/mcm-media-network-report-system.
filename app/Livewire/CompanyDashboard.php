<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MediaStatistic;
use App\Models\AdPerformance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CompanyDashboard extends Component
{
    public function render()
    {
        return view('livewire.company-dashboard');

    }
}
