<?php

namespace App\View\Composers;

use App\Models\Employee;
use Illuminate\View\View;

class EmployeeViewComposer
{
    public function compose(View $view): void
    {
        $view->with('employees', Employee::all());
    }
}
