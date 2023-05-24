<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

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

    public function showEmployeeShifts()
{
    // Retrieve the authenticated user
    $user = auth()->user();

    // Retrieve the shifts for the user
    $shifts = Shift::where('employee_id', $user->id)->get();

    return view('shiftplanner/employeeshift', compact('shifts'));
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
            'planned_start_time' => 'required|date_format:Y-m-d H:i:s',
            'planned_end_time' => 'required|date_format:Y-m-d H:i:s',
            'employee_id' => 'required|exists:users,id',
        ]);

        $existingShifts = Shift::where('employee_id', $data['employee_id'])
            ->whereDate('planned_start_time', '=', date('Y-m-d', strtotime($data['planned_start_time'])))
            ->get();

        $mergedShift = null;

        foreach ($existingShifts as $existingShift) {
            // Check if the new shift overlaps with any existing shift
            if (strtotime($data['planned_start_time']) <= strtotime($existingShift->planned_end_time)
                && strtotime($data['planned_end_time']) >= strtotime($existingShift->planned_start_time)
            ) {
                // Merge the shifts
                $mergedShift = $existingShift;
                $mergedShift->planned_start_time = min($data['planned_start_time'], $existingShift->planned_start_time);
                $mergedShift->planned_end_time = max($data['planned_end_time'], $existingShift->planned_end_time);
                $mergedShift->save();
            } else {
                // Delete the shift that doesn't overlap
                $existingShift->delete();
            }
        }

        if (! $mergedShift) {
            // Create a new shift
            $newShift = new Shift();
            $newShift->planned_start_time = $data['planned_start_time'];
            $newShift->planned_end_time = $data['planned_end_time'];
            $newShift->employee_id = $data['employee_id'];
            $newShift->actual_start_time = null;
            $newShift->actual_end_time = null;
            $newShift->created_at = now();
            $newShift->updated_at = now();
            $newShift->save();
        }

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

    public function start(Shift $shift)
    {
        // Perform logic to start the shift
        $shift->actual_start_time = now();
        $shift->save();

        return redirect()->back();
    }

    public function stop(Shift $shift)
    {
        // Perform logic to stop the shift
        $shift->actual_end_time = now();
        $shift->save();

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'planned_start_time' => 'required|date_format:Y-m-d H:i:s',
            'planned_end_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $shift = Shift::where('employee_id', $data['employee_id'])
            ->where('planned_start_time', $data['planned_start_time'])
            ->where('planned_end_time', $data['planned_end_time'])
            ->first();

        if ($shift) {
            $shift->delete();

            return response()->json(['message' => 'Shift deleted successfully']);
        } else {
            return response()->json(['message' => 'Shift not found'], 404);
        }
    }
}
