<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Address;
use App\Models\Employee;
use App\Models\EmployeeContract;
use App\Models\HolidaySaldo;
use App\Models\Position;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PDF;

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
        if ($req->startdate > $req->stopdate) {
            return redirect()->back()->withErrors(['alert' => 'End date cannot be before start date!']);
        }

        $existingEmployeeContracts = DB::table('employee_contracts')->where('employee_id', $req->employeeID)->get();
        $check = 1;
        for ($b = 0; $b < count($existingEmployeeContracts); $b++) {
            if ($existingEmployeeContracts[$b]->end_date > $req->startdate) {
                $check = 0;
            }
        }
        if ($check == 0) {
            return redirect()->back()->withErrors(['alert' => 'Employee already has a running contract on that starting date!']);
        }
        if ($req->startdate >= date('Y-m-d')) {
            $startyear = intval($req->startdate.substr(0, 4));
            $stopyear = intval($req->stopdate.substr(0, 4));
            $dayscheck = 1;

            $startdate = new DateTime($req->startdate);
            $stopdate = new DateTime($req->stopdate);

            $daysInStartYear = (clone $startdate)->modify('last day of December')->diff($startdate)->days;
            $daysInEndYear = (clone $stopdate)->modify('first day of January')->diff($stopdate)->days;

            $b = 0;
            for ($i = $startyear; $i <= $stopyear; $i++) {
                if (($req->{'days'.$b} >= 0)) {
                    if ($i == $startyear) {
                        if ($req->{'days'.$b} > $daysInStartYear) {
                            $dayscheck = 0;
                        }
                    }
                    if ($i == $stopyear) {
                        if ($req->{'days'.$b} > $daysInEndYear) {
                            $dayscheck = 0;
                        }
                    }
                    if ($i != $stopyear && $i != $startyear) {
                        if ($req->{'days'.$b} > 50) {
                            $dayscheck = 0;
                        }
                    }
                } else {
                    return redirect()->back()->withErrors(['alert' => 'Invalid data in vacation days!']);
                }
                $b += 1;
            }
            if ($dayscheck == 1) {
                $contract = new EmployeeContract();
                $contract->employee_id = $req->employeeID;
                $contract->start_date = $req->startdate;
                $contract->end_date = $req->stopdate;
                $contract->save();
                $employeeContractId = DB::table('employee_contracts')->latest()->value('id');
                $startyear = intval($req->startdate.substr(0, 4));
                $stopyear = intval($req->stopdate.substr(0, 4));
                $b = 0;
                for ($i = $startyear; $i <= $stopyear; $i++) {
                    $holidaySaldo = new HolidaySaldo();
                    $holidaySaldo->employee_contract_id = $employeeContractId;
                    $holidaySaldo->allowed_days = $req->{'days'.$b};
                    $holidaySaldo->year = $i;
                    $holidaySaldo->type = 1;
                    $holidaySaldo->save();
                    $b += 1;
                }
                if (strlen($req->input('position')) >= 3 && strlen($req->input('position')) < 25 && ! is_numeric($req->input('position'))) {
                    $newJobTitle = $req->input('position');
                } else {
                    return redirect()->back()->withErrors(['alert' => 'Invalid data in job title field!']);
                }
                $jobtitle = DB::table('positions')->where('name', $newJobTitle)->first();
                if ($jobtitle === null) {
                    $position = new Position();
                    $position->name = $newJobTitle;
                    $position->save();
                }
                $position = DB::table('positions')->where('name', $newJobTitle)->first();

                DB::table('position_to_employee_contract')->insert([
                    'start_date' => $req->startdate,
                    'end_date' => $req->stopdate,
                    'position_id' => $position->id,
                    'employee_contract_id' => $employeeContractId,
                ]);

                if ($req->salary < 20000 && $req->salary > 1000) {
                    $newSalary = $req->input('salary');

                    DB::table('employees')->where('id', $contract->employee_id)->update(['salary' => $newSalary]);
                } else {
                    return redirect()->back()->withErrors(['alert' => 'Invalid salary!']);
                }

                return redirect()->back()->with('alert', 'Succes!');
            }
        }

        return redirect()->back()->withErrors(['alert' => 'Invalid data!']);
    }

    public function view_contracts_index(): View|Factory
    {
        $i = 0;
        $contracts = DB::table('employee_contracts')->get();
        $users = [];
        foreach ($contracts as $contract) {
            $userid = DB::table('employees')->where('id', $contract->employee_id)->value('user_id');
            $username = DB::table('users')->where('id', $userid)->value('name');
            $userlastname = DB::table('users')->where('id', $userid)->value('last_name');

            $users[$i]['contractID'] = $contract->id;
            $users[$i]['employeeID'] = $contract->employee_id;
            $users[$i]['lastname'] = $userlastname;
            $users[$i]['name'] = $username;
            $users[$i]['startdate'] = $contract->start_date;
            $users[$i]['enddate'] = $contract->end_date;
            $i += 1;
        }

        return view('employee_view_contracts', ['contracts' => $users]);
    }

    public function contract_index(): View|Factory
    {
        $i = 0;
        $employees = DB::table('employees')->get();
        $users = [];
        foreach ($employees as $employee) {
            $username = DB::table('users')->where('id', $employee->user_id)->value('name');
            $userlastname = DB::table('users')->where('id', $employee->user_id)->value('last_name');
            $users[$i]['employeeID'] = $employee->id;
            $users[$i]['lastname'] = $userlastname;
            $users[$i]['name'] = $username;

            $i += 1;
        }

        return view('employee_add_contract', ['users' => $users]);
    }

    public function searchEmployeeContract(Request $req)
    {
        $comboArray = [];
        if ($req->filled('queryF')) {
            $queryF = $req->input('queryF');
        }
        if ($req->filled('queryL')) {
            $queryL = $req->input('queryL');
        }

        if (isset($queryF) && isset($queryL)) {
            $employeeUsers = DB::table('users')->where('name', $queryF)->where('last_name', $queryL)->get();
        }
        if (isset($queryF) && ! isset($queryL)) {
            $employeeUsers = DB::table('users')->where('name', $queryF)->get();
        }
        if (! isset($queryF) && isset($queryL)) {
            $employeeUsers = DB::table('users')->where('last_name', $queryL)->get();
        }

        if (isset($employeeUsers)) {
            for ($i = 0; $i < count($employeeUsers); $i++) {
                $employeeID = DB::table('employees')->where('user_id', $employeeUsers[$i]->id)->value('id');

                $contractsPerUser = DB::table('employee_contracts')->where('employee_id', $employeeID)->get();

                for ($b = 0; $b < count($contractsPerUser); $b++) {
                    $comboArray[$b]['id'] = $contractsPerUser[$b]->id;
                    $comboArray[$b]['employee_id'] = $contractsPerUser[$b]->employee_id;
                    $comboArray[$b]['start_date'] = $contractsPerUser[$b]->start_date;
                    $comboArray[$b]['stop_date'] = $contractsPerUser[$b]->end_date;
                    $comboArray[$b]['name'] = $employeeUsers[$i]->name;
                    $comboArray[$b]['last_name'] = $employeeUsers[$i]->last_name;
                }
            }
        }

        return view('employee_view_contracts', ['comboArray' => $comboArray]);
    }

    public function employeeContractDetails(Request $req)
    {
        $data = [];
        $contractID = $req->contractID;
        $contract = DB::table('employee_contracts')->where('id', $contractID)->first();
        $holidays = DB::table('holiday_saldos')->where('employee_contract_id', $contractID)->get();
        $employee = DB::table('employees')->where('id', $contract->employee_id)->first();
        $user = DB::table('users')->where('id', $employee->user_id)->first();
        $data['contractID'] = $contractID;
        $data['name'] = $user->name;
        $data['last_name'] = $user->last_name;
        $data['startdate'] = $contract->start_date;
        $data['stopdate'] = $contract->end_date;
        $data['created_at'] = $contract->created_at;
        $data['position'] = $employee->jobTitle;
        $data['salary'] = $employee->salary;

        $holidaysList = [];
        for ($i = 0; $i < count($holidays); $i++) {
            $holidaysList[$i]['year'] = $holidays[$i]->year;
            $holidaysList[$i]['allowed_days'] = $holidays[$i]->allowed_days;
        }

        return view('employee_contract_details', ['data' => $data, 'data2' => $holidaysList]);
    }

    //run -> composer require barryvdh/laravel-dompdf <- for it to work
    public function createEmployeeContractPDF(Request $req)
    {
        $data = [];
        $contractID = $req->contractID;
        $contract = DB::table('employee_contracts')->where('id', $contractID)->first();
        $holidays = DB::table('holiday_saldos')->where('employee_contract_id', $contractID)->get();
        $employee = DB::table('employees')->where('id', $contract->employee_id)->first();
        $user = DB::table('users')->where('id', $employee->user_id)->first();
        $data['contractID'] = $contractID;
        $data['name'] = $user->name;
        $data['last_name'] = $user->last_name;
        $data['startdate'] = $contract->start_date;
        $data['stopdate'] = $contract->end_date;
        $data['created_at'] = $contract->created_at;
        $data['position'] = $employee->jobTitle;
        $data['salary'] = $employee->salary;
        $holidaysList = [];
        for ($i = 0; $i < count($holidays); $i++) {
            $holidaysList[$i]['year'] = $holidays[$i]->year;
            $holidaysList[$i]['allowed_days'] = $holidays[$i]->allowed_days;
        }

        $pdf = PDF::loadView('pdf/employeeContract', ['data' => $data, 'data2' => $holidaysList]);

        return $pdf->download('Employee-'.$data['last_name'].'-'.$data['name'].'-Contract.pdf');
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
                $addressId = DB::table('addresses')->where('street', $req->street)->where('house_number', $req->houseNumber)->value('id');

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

                $userId = DB::table('users')->where('email', $req->email)->where('name', $req->name)->value('id');

                $employee->user_id = $userId;
                $employee->dateOfBirth = $req->dateOfBirth;
                $employee->jobTitle = $req->jobTitle;
                $employee->salary = $req->salary;
                $employee->Iban = $req->Iban;
                $employee->save();

                return redirect()->back()->with('alert', 'Employee Created');
            }
        }

        return redirect()->back()->withErrors(['alert' => 'Invalid data!']);
    }
}
