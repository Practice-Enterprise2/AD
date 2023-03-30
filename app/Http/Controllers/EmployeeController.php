<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function employee_page(): View|Factory
    {
        return 'employee' == Auth::user()->roles()->first()->name ||
            'admin' == Auth::user()->roles()->first()->name ? view('employee') : abort(404);
    }

    public function employees(): View|Factory
    {
        $tickets = DB::select('SELECT ticketID, cstID, employeeID, issue, description, solution, status FROM tickets');

        return view('employee_view', ['tickets' => $tickets]);
    }
}
