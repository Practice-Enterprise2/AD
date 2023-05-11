<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Role;
use Illuminate\Http\Request;
use DateTime;


class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = now()->toDateString();
        $employees = Employee::with('user')->get();

        //$shifts = Shift::whereDate('planned_start_time', $date)->get();
        $shifts = Shift::all();
        return view('shiftplanner/shiftplanner', compact('employees', 'shifts', 'date'));
    }

    public function shiftsCount($date)
    {
        $shiftsCount = Shift::whereDate('planned_start_time', $date)->count();
        return response()->json($shiftsCount);
    }

    public function showDayView($date)
    {
        // Convert the date from the route parameter to a DateTime object
        $dateTime = new DateTime($date);
    
        // Retrieve all employees
        $employees = Employee::all();
    
        // Retrieve the shifts for the selected date
        $shifts = Shift::whereDate('planned_start_time', $dateTime->format('Y-m-d'))->get();
    
        //Retrieve all users
        $users = User::all(); // Retrieve all users

        $positions = Position::all();
        
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
            'users' => $users,
            'positions' => $positions,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
    $data = $request->validate([
        'user_id' => 'required|exists:user,id',
        'planned_start_time' => 'required|date_format:Y-m-d\TH:i',
        'planned_end_time' => 'required|date_format:Y-m-d\TH:i',
    ]);

    Shift::create([
        'planned_start_time' => $data['planned_start_time'],
        'planned_end_time' => $data['planned_end_time'],
        'employee_id' => $data['user_id'],
    ]);

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