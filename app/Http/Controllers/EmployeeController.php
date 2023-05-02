<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function employee_page(): View|Factory
    {
        return view('employee');
    }

    public function employees(): View|Factory
    {
        $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

        return view('employee_view', ['tickets' => $tickets]);
    }
    public function contract_index(): View|Factory
    {
        return view('employee_add_contract');
    }
    public function contract_save(Request $req): RedirectResponse
    {
        $contract = new EmployeeContract();
        $contract->employee_id = $req->employeeID;
        $contract->start_date = $req->startdate;
        $contract->end_date = $req->stopdate;
        $contract->save();
        return redirect()->back()->with('alert', 'complete creation');
    }

}
