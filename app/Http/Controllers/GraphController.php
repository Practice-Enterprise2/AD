<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContract;
use Illuminate\Support\Carbon;

class GraphController extends Controller
{
    public function index()
    {
        $contracts = EmployeeContract::whereNotNull('end_date')->get();

        $employees = collect([]);

        foreach ($contracts as $contract) {
            $startDate = Carbon::parse($contract->start_date);
            $endDate = Carbon::parse($contract->end_date);

            for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
                $employees->push([
                    'month' => $date->format('F Y'),
                    'employee_id' => $contract->employee_id,
                ]);
            }
        }

        $data = $employees->groupBy('month')->map(function ($group) {
            return $group->unique('employee_id')->count();
        });

        $countpm = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $data->get(Carbon::create(null, $i, 1)->format('F Y'));
            $count = $monthData ? $monthData : 0;
            $countpm[] = $count;
        }
        $contracts = EmployeeContract::whereYear('end_date', '>=', Carbon::now()->year)->get();

        $employees = collect([]);

        foreach ($contracts as $contract) {
            $startDate = Carbon::parse($contract->start_date);
            $endDate = Carbon::parse($contract->end_date);

            for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
                $employees->push([
                    'year' => $date->year,
                    'employee_id' => $contract->employee_id,
                ]);
            }
        }

        $data = $employees->groupBy('year')->map(function ($group) {
            return $group->unique('employee_id')->count();
        });

        $countpy = [];
        for ($year = Carbon::now()->year; $year >= Carbon::now()->subYears(4)->year; $year--) {
            $count = $data->get($year);
            $countpy[] = $count ? $count : 0;
        }

        return view('employeegraph', ['countpm' => $countpm, 'countpy' => $countpy, 'year' => $year]);
    }
}
