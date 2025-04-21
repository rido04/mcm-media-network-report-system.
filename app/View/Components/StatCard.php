<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public $label;
    public $value;
    public $color;
    public function __construct($label, $value, $color = 'gray') 
    {
        
        $this->label = $label;
        $this->value = $value;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }
}
