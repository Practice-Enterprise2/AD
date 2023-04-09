<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
}
