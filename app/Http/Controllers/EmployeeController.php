<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Address;
use App\Models\Employee;
use App\Models\EmployeeContract;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        $search_query = $request->input('query');

        if ($search_query != null) {
            $search_query = (string) $search_query;

            if ($search_query == null) {
                abort(Response::HTTP_BAD_REQUEST);
            }
        }

        if ($search_query != null) {
            $employees = Employee::query()->whereHas('user', function ($query) use ($search_query) {
                $query->where('name', 'LIKE', "%$search_query%");
            })->get();
        } else {
            $employees = Employee::all();
        }

        return view('employees.index', ['employees' => $employees]);
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
    public function create(): View
    {
        return view('employees.create');
    }

    public function edit(int $employee): View
    {
        $employee = Employee::query()->findOrFail($employee);

        return view('employees.edit', ['employee' => $employee]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        if ($employee->user->name != $request->user_name) {
            $employee->user->name = $request->user_name;
        }
        if ($employee->user->last_name != $request->user_last_name) {
            $employee->user->last_name = $request->user_last_name;
        }
        if ($employee->user->email != $request->user_email) {
            $employee->user->email = $request->user_email;
        }
        if ($employee->email != $request->email) {
            $employee->email = $request->email;
        }
        if ($employee->user->address->street != $request->user_address_street) {
            $employee->user->address->street = $request->user_address_street;
        }
        if ($employee->user->address->house_number != $request->user_address_house_number) {
            $employee->user->address->house_number = $request->user_address_house_number;
        }
        if ($employee->user->address->postal_code != $request->user_address_postal_code) {
            $employee->user->address->postal_code = $request->user_address_postal_code;
        }
        if ($employee->user->address->city != $request->user_address_city) {
            $employee->user->address->city = $request->user_address_city;
        }
        if ($employee->user->address->region != $request->user_address_region) {
            $employee->user->address->region = $request->user_address_region;
        }
        if ($employee->user->address->country != $request->user_address_country) {
            $employee->user->address->country = $request->user_address_country;
        }
        if ($employee->user->phone != $request->user_phone) {
            $employee->user->phone = $request->user_phone;
        }
        if ($employee->dateOfBirth != $request->dateOfBirth) {
            $employee->dateOfBirth = $request->dateOfBirth;
        }
        if ($employee->jobTitle != $request->jobTitle) {
            $employee->jobTitle = $request->jobTitle;
        }
        if ($employee->salary != $request->salary) {
            $employee->salary = $request->salary;
        }
        if ($employee->Iban != $request->Iban) {
            $employee->Iban = $request->Iban;
        }

        $employee->user->address->save();
        $employee->user->save();
        $employee->save();

        return redirect()->route('employees.index');
    }

    public function store(Request $req): RedirectResponse
    {
        $IBAN = $req->Iban;
        $countries = ['al' => 28, 'ad' => 24, 'at' => 20, 'az' => 28, 'bh' => 22, 'be' => 16, 'ba' => 20, 'br' => 29, 'bg' => 22, 'cr' => 21, 'hr' => 21, 'cy' => 28, 'cz' => 24, 'dk' => 18, 'do' => 28, 'ee' => 20, 'fo' => 18, 'fi' => 18, 'fr' => 27, 'ge' => 22, 'de' => 22, 'gi' => 23, 'gr' => 27, 'gl' => 18, 'gt' => 28, 'hu' => 28, 'is' => 26, 'ie' => 22, 'il' => 23, 'it' => 27, 'jo' => 30, 'kz' => 20, 'kw' => 30, 'lv' => 21, 'lb' => 28, 'li' => 21, 'lt' => 20, 'lu' => 20, 'mk' => 19, 'mt' => 31, 'mr' => 27, 'mu' => 30, 'mc' => 27, 'md' => 24, 'me' => 22, 'nl' => 18, 'no' => 15, 'pk' => 24, 'ps' => 29, 'pl' => 28, 'pt' => 25, 'qa' => 29, 'ro' => 24, 'sm' => 27, 'sa' => 24, 'rs' => 22, 'sk' => 24, 'si' => 19, 'es' => 24, 'se' => 24, 'ch' => 21, 'tn' => 24, 'tr' => 26, 'ae' => 23, 'gb' => 22, 'vg' => 24,
            'AL' => 28, 'AD' => 24, 'AT' => 20, 'AZ' => 28, 'BH' => 22, 'BE' => 16, 'BA' => 20, 'BR' => 29, 'BG' => 22, 'CR' => 21, 'HR' => 21, 'CY' => 28, 'CZ' => 24, 'DK' => 18, 'DO' => 28, 'EE' => 20, 'FO' => 18, 'FI' => 18, 'FR' => 27, 'GE' => 22, 'DE' => 22, 'GI' => 23, 'GR' => 27, 'GL' => 18, 'GT' => 28, 'HU' => 28, 'IS' => 26, 'IE' => 22, 'IL' => 23, 'IT' => 27, 'JO' => 30, 'KZ' => 20, 'KW' => 30, 'LV' => 21, 'LB' => 28, 'LI' => 21, 'LT' => 20, 'LU' => 20, 'MK' => 19, 'MT' => 31, 'MR' => 27, 'MU' => 30, 'MC' => 27, 'MD' => 24, 'ME' => 22, 'NL' => 18, 'NO' => 15, 'PK' => 24, 'PS' => 29, 'PL' => 28, 'PT' => 25, 'QA' => 29, 'RO' => 24, 'SM' => 27, 'SA' => 24, 'RS' => 22, 'SK' => 24, 'SI' => 19, 'ES' => 24, 'SE' => 24, 'CH' => 21, 'TN' => 24, 'TR' => 26, 'AE' => 23, 'GB' => 22, 'VG' => 24];
        $chars = ['a' => '10', 'b' => '11', 'c' => '12', 'd' => '13', 'e' => '14', 'f' => '15', 'g' => '16', 'h' => '17', 'i' => '18', 'j' => '19', 'k' => '20', 'l' => '21', 'm' => '22', 'n' => '23', 'o' => '24', 'p' => '25', 'q' => '26', 'r' => '27', 's' => '28', 't' => '29', 'u' => '30', 'v' => '31', 'w' => '32', 'x' => '33', 'y' => '34', 'z' => '35',
            'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => '14', 'F' => '15', 'G' => '16', 'H' => '17', 'I' => '18', 'J' => '19', 'K' => '20', 'L' => '21', 'M' => '22', 'N' => '23', 'O' => '24', 'P' => '25', 'Q' => '26', 'R' => '27', 'S' => '28', 'T' => '29', 'U' => '30', 'V' => '31', 'W' => '32', 'X' => '33', 'Y' => '34', 'Z' => '35'];

        if (array_key_exists(substr($IBAN, 0, 2), $countries) && strlen($IBAN) == $countries[substr($IBAN, 0, 2)]) {
            $firstFour = substr($IBAN, 0, 4);
            $rest = substr($IBAN, 4);
            $IBANrearranged = $rest.$firstFour;

            $numericIBAN = '';
            $rearrangedArray = str_split($IBANrearranged);

            foreach ($rearrangedArray as $key => $value) {
                if (! is_numeric($rearrangedArray[$key])) {
                    if (! isset($chars[$rearrangedArray[$key]])) {
                        return redirect()->back()->with('alert', 'Problem occured!');
                    }
                    $rearrangedArray[$key] = $chars[$rearrangedArray[$key]];
                }
                $numericIBAN .= $rearrangedArray[$key];
            }
            if (bcmod($numericIBAN, '97') == 1) {
                $employee = new Employee();
                $address = new Address();

                $address->street = $req->street;
                $address->house_number = $req->houseNumber;
                $address->postal_code = $req->postalCode;
                $address->city = $req->city;
                $address->region = $req->province;
                $address->country = $req->country;
                $address->save();
                $addressId = FacadesDB::table('addresses')->where('street', $req->street)->where('house_number', $req->houseNumber)->value('id');

                User::query()->insert([
                    'address_id' => $addressId,
                    'name' => $req->name,
                    'last_name' => $req->last_name,
                    'email' => $req->email,
                    'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
                    'phone' => $req->phoneNumber,
                    'role' => 2,
                    'email_verified_at' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);

                $userId = FacadesDB::table('users')->where('email', $req->email)->where('name', $req->name)->value('id');

                $employee->user_id = $userId;
                $employee->dateOfBirth = $req->dateOfBirth;
                $employee->jobTitle = $req->jobTitle;
                $employee->salary = $req->salary;
                $employee->Iban = $req->Iban;
                $employee->save();

                return redirect()->back()->with('alert', 'complete creation');
            }
        }

        return redirect()->back()->with('alert', 'Invalid IBAN!');
    }
}
