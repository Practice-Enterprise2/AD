<?php

namespace App\Http\Livewire\Employees;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

// TODO: Find out how to support search here. It is hard to do cleanly like on
// the other models as the query needs to both check (1) whether the relation
// exists (otherwise it shouldn't be included at all) and (2) whether the search
// term is included in the fields.
class Index extends Component
{
    public function render(): View
    {
        return view('livewire.employees.index', ['employee_users' => User::query()->whereHas('employee')->get()]);
    }
}
