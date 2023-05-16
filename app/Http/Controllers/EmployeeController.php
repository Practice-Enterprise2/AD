<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\Factory;

use App\Models\HolidaySaldo;
use App\Models\EmployeeContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function employee_page(): View
    {
        return view('employee');
    }

    public function employees(): View
    {
        $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

        return view('employee_view', ['tickets' => $tickets]);
    }

    public function view_contracts_index(): View|Factory
    {
        $i = 0;
        $contracts = DB::table('employee_contracts')->get();
        $users = [];
        foreach ($contracts as $contract) {
            $userid = DB::table('employees')->where('id', $contract->employee_id)->value('user_id');
            $username = DB::table('users')->where('id', $userid)->value('name');
            $userlastname = DB::table('users')->where('id', $userid)->value('last_name');

            $users[$i]['contractID'] = $contract->id;
            $users[$i]['employeeID'] = $contract->employee_id;
            $users[$i]['lastname'] = $userlastname;
            $users[$i]['name'] = $username;
            $users[$i]['startdate'] = $contract->start_date;
            $users[$i]['enddate'] = $contract->end_date;
            $i += 1;
        }

        return view('employee_view_contracts', ['contracts' => $users]);
    }

    public function create_contract_index(): View|Factory
    {
        $i = 0;
        $employees = DB::table('employees')->get();
        $users = [];
        foreach ($employees as $employee) {
            $username = DB::table('users')->where('id', $employee->user_id)->value('name');
            $userlastname = DB::table('users')->where('id', $employee->user_id)->value('last_name');
            $users[$i]['employeeID'] = $employee->id;
            $users[$i]['lastname'] = $userlastname;
            $users[$i]['name'] = $username;

            $i += 1;
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
        sleep(2);
        $contractId = DB::table('employee_contracts')->where('employee_id', $req->employeeID)->value('id');
        $startyear =  intval($req->startdate.substr(0,4));
        $stopyear = intval($req->stopdate.substr(0,4));
        for($i = $startyear; $i<$stopyear; $i++)
        {
            $year = $startyear+$i-1;
            $holidaySaldo = new HolidaySaldo();
            $holidaySaldo->contract_id = $contractId;
            $holidaySaldo->allowed_days = $req->days.$i;
            $holidaySaldo->year = $i+1;
            $holidaySaldo->type = 1;
            $holidaySaldo->save();
        }

        return redirect()->back()->with('alert', 'complete creation');
    }

}
