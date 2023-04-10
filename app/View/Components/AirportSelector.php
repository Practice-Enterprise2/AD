<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AirportSelector extends Component
{
    /**
     * Create a new component instance.
     */
    public $inputName;

    public function __construct(string $inputName)
    {
        //
        $this->inputName = $inputName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.airport-selector');
    }
}
