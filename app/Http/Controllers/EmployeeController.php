<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\Factory;

use App\Models\HolidaySaldo;
use App\Models\EmployeeContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
        if($req->startdate >= date("Y-m-d"))
        {
            $startyear =  intval($req->startdate.substr(0,4));
            $stopyear = intval($req->stopdate.substr(0,4));
            $dayscheck = 1;
            $b=0;
            for($i = $startyear; $i<=$stopyear; $i++)
            {
                if($req->{'days' . $b} > 50)
                {
                    $dayscheck = 0;
                }
                $b+=1;
            }
            if($dayscheck == 1)
            {
                $contract = new EmployeeContract();
                $contract->employee_id = $req->employeeID;
                $contract->start_date = $req->startdate;
                $contract->end_date = $req->stopdate;
                $contract->save();
                $employeeContractId = DB::table('employee_contracts')->latest()->value('id');
                $startyear =  intval($req->startdate.substr(0,4));
                $stopyear = intval($req->stopdate.substr(0,4));
                $b=0;
                for($i = $startyear; $i<=$stopyear; $i++)
                {
                    
                    
                    $holidaySaldo = new HolidaySaldo();
                    $holidaySaldo->employee_contract_id = $employeeContractId;
                    $holidaySaldo->allowed_days = $req->{'days' . $b};
                    $holidaySaldo->year = $i;
                    $holidaySaldo->type = 1;
                    $holidaySaldo->save();
                    $b+=1;
                }

                return redirect()->back()->with('alert', 'Succes!');
            }
        }
        return redirect()->back()->withErrors(['alert' => 'Invalid data!']);
    }
    public function searchEmployeeContract(Request $req)
    {
        
        $comboArray = array();
        if($req->filled('queryF'))
        {
            $queryF = $req->input('queryF');
        }
        if($req->filled('queryL'))
        {
            $queryL = $req->input('queryL');
        }
        
        
        if(isset($queryF) && isset($queryL))
        {
            $employeeUsers = DB::table('users')->where('name', $queryF)->where('last_name', $queryL)->get();
        }
        if(isset($queryF) && !isset($queryL))
        {
            $employeeUsers = DB::table('users')->where('name', $queryF)->get();
        }
        if(!isset($queryF) && isset($queryL))
        {
            $employeeUsers = DB::table('users')->where('last_name', $queryL)->get();
        }
        
        
        if(isset($employeeUsers))
        {
            for($i = 0 ; $i < count($employeeUsers); $i++)
            {
                $employeeID = DB::table('employees')->where('user_id', $employeeUsers[$i]->id)->value('id');
                
                $contractsPerUser = DB::table('employee_contracts')->where('employee_id', $employeeID)->get();
        
                for($b = 0; $b<count($contractsPerUser); $b++)
                {
                    
                    $comboArray[$b]['id'] = $contractsPerUser[$b]->id;
                    $comboArray[$b]['employee_id'] = $contractsPerUser[$b]->employee_id;
                    $comboArray[$b]['start_date'] = $contractsPerUser[$b]->start_date;
                    $comboArray[$b]['stop_date'] = $contractsPerUser[$b]->end_date;
                    $comboArray[$b]['name'] = $employeeUsers[$i]->name;
                    $comboArray[$b]['last_name'] = $employeeUsers[$i]->last_name;
                }

                
            }

        }
    
        return view('employee_view_contracts', ['comboArray' => $comboArray]);
    }
    public function employeeContractDetails(Request $req)
    {
        $data = array();
        $contractID = $req->contractID;
        $contract = DB::table('employee_contracts')->where('id', $contractID)->first();
        $employee = DB::table('employees')->where('id', $contract->employee_id)->first();
        $user = DB::table('users')->where('id', $employee->user_id)->first();
        $data["contractID"] = $contractID;
        $data["name"] = $user->name;
        $data["last_name"] = $user->last_name;
        $data["startdate"] = $contract->start_date;
        $data["stopdate"] = $contract->end_date;
        $data["created_at"] = $contract->created_at;
        $data["position"] = $employee->jobTitle;
        $data["salary"] = $employee->salary;
        return view('employee_contract_details', ['data' => $data]);
    }
    //run -> composer require barryvdh/laravel-dompdf <- for it to work
    public function createEmployeeContractPDF(Request $req){
        $data = array();
        $contractID = $req->contractID;
        $contract = DB::table('employee_contracts')->where('id', $contractID)->first();
        $employee = DB::table('employees')->where('id', $contract->employee_id)->first();
        $user = DB::table('users')->where('id', $employee->user_id)->first();
        $data["contractID"] = $contractID;
        $data["name"] = $user->name;
        $data["last_name"] = $user->last_name;
        $data["startdate"] = $contract->start_date;
        $data["stopdate"] = $contract->end_date;
        $data["created_at"] = $contract->created_at;
        $data["position"] = $employee->jobTitle;
        $data["salary"] = $employee->salary;
        
        $pdf = PDF::loadView('pdf/employeeContract', ['data' => $data]);
        return $pdf->download('EmployeeContract.pdf');
    }
}
