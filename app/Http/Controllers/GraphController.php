<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class GraphController extends Controller
{
    public function index()
    {
        $data = Employee::selectRaw('MONTH(dateOfBirth) as month, COUNT(*) as count')
                        ->groupBy('month')
                        ->get();


        $countpm = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $data->where('month', $i)->first();
            $count = $monthData ? $monthData->count : 0;
            $countpm[] = $count;
        }

        return view('employeegraph', ['data' => $countpm]);
    }
}
