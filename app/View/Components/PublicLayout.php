<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Layout for pages that are publicly available without needing to authenticate.
 */
class PublicLayout extends Component
{
    public function render(): View
    {
        return view('layouts.public');
    }
}
