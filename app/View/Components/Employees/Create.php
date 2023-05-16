<?php

namespace App\View\Components\Employees;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Create extends Component
{
    public function render(): View
    {
        return view('components.employees.create');
    }
}
