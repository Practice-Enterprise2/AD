<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeContractController extends Controller
{
    public function create(Employee $employee): View
    {
        return view('employees.contracts.create', ['employee' => $employee]);
    }

    public function store(Request $req): RedirectResponse
    {
        $contract = new EmployeeContract();
        $contract->employee_id = $req->employeeID;
        $contract->start_date = $req->startdate;
        $contract->end_date = $req->stopdate;
        $contract->save();

        return redirect()->back()->with('alert', 'complete creation');
    }
}
