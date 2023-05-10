<?php

namespace App\View\Components\Public;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Header for pages that are publicly available.
 */
class Header extends Component
{
    public function render(): View
    {
        return view('components.public.header');
    }
}
