<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
