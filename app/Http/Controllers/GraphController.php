<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Carbon;

class GraphController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $data = Employee::selectRaw('MONTH(employee_contracts.start_date) as month, COUNT(*) as count')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->where('employee_contracts.start_date', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->where('employee_contracts.end_date', '>=', $now)
                ->orWhereNull('employee_contracts.end_date');
        })
        ->groupBy('month')
        ->get();

        $countpm = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $data->where('month', $i)->first();
            $count = $monthData ? $monthData->count : 0;
            $countpm[] = $count;
        }

        return view('employeegraph', ['countpm' => $countpm]);
    }
}
