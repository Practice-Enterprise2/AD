<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;


class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::with('employee')->get();
    
        return view('shiftplanner/shiftplanner', compact('shifts'));
    }

    public function showDayView($date)
    {
        // Convert the date from the route parameter to a DateTime object
        $dateTime = new DateTime($date);
    
        // Retrieve all employees
        $employees = Employee::all();
    
        // Retrieve the shifts for the selected date
        $shifts = Shift::whereDate('planned_start_time', $dateTime->format('Y-m-d'))->get();
    
        // Create an empty array to hold the shifts for each employee
        $shiftsByEmployee = [];
    
        // Loop through each employee
        foreach ($employees as $employee) {
            // Create an array to hold the shifts for the current employee
            $employeeShifts = [];
    
            // Loop through each shift and add it to the current employee's array if it belongs to them
            foreach ($shifts as $shift) {
                if ($shift->employee_id == $employee->id) {
                    $employeeShifts[] = $shift;
                }
            }
    
            // Add the employee's array of shifts to the main array of shifts, keyed by the employee's name
            $shiftsByEmployee[$employee->name] = $employeeShifts;
        }
    
        // Pass the shifts, date, and shiftsByEmployee to the view
        return view('shiftplanner.day', [
            'shifts' => $shifts,
            'date' => $dateTime->format('Y-m-d'),
            'shiftsByEmployee' => $shiftsByEmployee,
            'employees' => $employees,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shift = new Shift();
        
        $shift->planned_start_time = $request->input('planned_start_time');
        $shift->planned_end_time = $request->input('planned_end_time');
        $shift->employee_id = $request->input('employee_id');
        
        $shift->save();
        
        return redirect()->route('shifts.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        $shift->actual_start_time = $request->input('actual_start_time');
        $shift->actual_end_time = $request->input('actual_end_time');
        
        $shift->save();
        
        return redirect()->route('shifts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        
        return redirect()->route('shifts.index');
    }
}