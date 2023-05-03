<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContract;
use Illuminate\Support\Carbon;

class GraphController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $data = EmployeeContract::selectRaw('MONTH(start_date) as month, COUNT(*) as count')
            ->where('start_date', '<=', $now)
            ->where(function ($query) use ($now) {
                $query->where('end_date', '>=', $now)
                    ->orWhereNull('end_date');
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
