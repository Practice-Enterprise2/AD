<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $i=0;
        $employees = DB::table('employees')->get();
        $users=[];
        foreach($employees as $employee)
        {
            
            $username =  DB::table('users')->where('id', $employee->user_id)->value('name');
            $userlastname =  DB::table('users')->where('id', $employee->user_id)->value('last_name');
            $users[$i]['employeeID'] = $employee->id;
            $users[$i]['lastname'] = $userlastname;
            $users[$i]['name'] = $username;

            $i+=1;
        }
        return view('employee_add_contract', ['users' => $users]);
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
