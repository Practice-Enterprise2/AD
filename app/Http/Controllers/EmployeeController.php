<?php

namespace App\Http\Controllers;

use App\Models\EmployeeContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function contract_index(): View
    {
        return view('employee_add_contract');
    }

    public function contract_save(Request $req): RedirectResponse
    {
        $contract = new EmployeeContract();
        $contract->employee_id = $req->employeeID;
        $contract->start_date = $req->startdate;
        $contract->end_date = $req->stopdate;
        $contract->save();

        return redirect()->back()->with('alert', 'complete creation');
    }
    public function end()
    {
        $employees = Employee::whereHas('employee_contracts', function ($query) {
            $query->whereNotNull('start_date')->whereNotNull('end_date');
        })
            ->with(['employee_contracts', 'user' => function ($query) {
                $query->select('id', 'name', 'last_name');
            }])
            ->get(['id', 'user_id']);

        $employeeIds = $employees->pluck('user_id')->toArray();

        $users = User::whereIn('id', $employeeIds)->get();

        $employeesWithUsers = $employees->map(function ($employee) use ($users) {
            $user = $users->firstWhere('id', $employee->user_id);
            if ($user) {
                $employee->user = $user;
                $employee->name = $user->name;
                $employee->last_name = $user->last_name;
            }

            return $employee;
        });

        return view('endcontract', compact('employeesWithUsers'));
    }

    public function determine($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $contract = $employee->employee_contracts()->first();
        $user = User::findOrFail($employee->user_id);

        $employee->user = $user;
        $employee->name = $user->name;
        $employee->last_name = $user->last_name;

        $pdf = PDF::loadView('cvier', ['employee' => $employee, 'contract' => $contract]);

        $pdfPath = public_path('pdf_files/pdf_file.pdf');
        $pdfDirectory = dirname($pdfPath);

        if (! File::isDirectory($pdfDirectory)) {
            File::makeDirectory($pdfDirectory, 0755, true, true);
        }

        $pdf->save($pdfPath);

        if ($contract) {
            $contract->delete();

            return response()->download($pdfPath)->deleteFileAfterSend(true);
        } else {
            return redirect('/home')->back()->with('error', 'No contract found.');
        }
    }

    public function renew($employee)
    {
        $employee = Employee::findOrFail($employee);
        $contract = $employee->employee_contracts();
        $contract->delete();

        return redirect('/employee_add_contract');
    }
}
