<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class EmployeeViewController extends Controller
{
    public function showAdd()
    {
        return view('add_employee');
    }

    public function employeeEdit()
    {
        $array = [];
        $array['id'] = $_POST['employeeId'];
        $array['name'] = $_POST['employeeFirstName'];
        $array['lastName'] = $_POST['employeeLastName'];
        $array['userID'] = $_POST['userId'];

        return view('employee_edit', ['array' => $array]);
    }

    public function index(): View
    {
        $employees = FacadesDB::select('select * from employees');
        $users = FacadesDB::select('select * from users');
        $address = FacadesDB::select('select * from addresses');

        $comboArray = [[]];
        for ($i = 0; $i < count($employees); $i++) {
            $comboArray[$i][0] = $employees[$i]->id;
            $comboArray[$i][1] = $employees[$i]->user_id;
            $temp = FacadesDB::table('users')->where('id', $employees[$i]->user_id)->first();
            $comboArray[$i][2] = $temp->name;
            $comboArray[$i][3] = $temp->last_name;
            $comboArray[$i][4] = $temp->email;
            $comboArray[$i][5] = $employees[$i]->dateOfBirth;
            $comboArray[$i][6] = $employees[$i]->jobTitle;
            $comboArray[$i][7] = $employees[$i]->salary;
        }

        return view('employee_view', ['employees' => $comboArray]);
    }

    public function employeeEditSave(Request $req)
    {
        $userID = $_POST['userId'];
        if ($req->name != '') {
            User::where('id', $userID)
                ->update(['name' => $req->name]);
        }
        if ($req->last_name != '') {
            User::where('id', $userID)
                ->update(['last_name' => $req->last_name]);
        }
        if ($req->email != '') {
            User::where('id', $userID)
                ->update(['email' => $req->email]);
        }
        if ($req->phoneNumber != '') {
            User::where('id', $userID)
                ->update(['phone' => $req->phoneNumber]);
        }
        $addressID = FacadesDB::table('users')->where('id', $userID)->value('address_id');
        if ($req->street != '') {
            Address::where('id', $addressID)
                ->update(['street' => $req->street]);
        }
        if ($req->houseNumber != '') {
            Address::where('id', $addressID)
                ->update(['house_number' => $req->houseNumber]);
        }
        if ($req->PostalCode != '') {
            Address::where('id', $addressID)
                ->update(['postal_code' => $req->PostalCode]);
        }
        if ($req->city != '') {
            Address::where('id', $addressID)
                ->update(['city' => $req->city]);
        }
        if ($req->province != '') {
            Address::where('id', $addressID)
                ->update(['region' => $req->province]);
        }
        if ($req->country != '') {
            Address::where('id', $addressID)
                ->update(['country' => $req->country]);
        }
        if ($req->dateOfBirth != '') {
            Employee::where('user_id', $userID)
                ->update(['dateOfBirth' => $req->dateOfBirth]);
        }
        if ($req->jobTitle != '') {
            Employee::where('user_id', $userID)
                ->update(['jobTitle' => $req->jobTitle]);
        }
        if ($req->salary != '') {
            Employee::where('user_id', $userID)
                ->update(['salary' => $req->salary]);
        }
        if ($req->Iban != '') {
            Employee::where('user_id', $userID)
                ->update(['Iban' => $req->Iban]);
        }

        return $this->index();
    }

    public function save(Request $req): RedirectResponse
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

                /* $user['address_id'] = $addressId;
                $user['name'] = $req->firstName;
                $user['last_name'] = $req->lastName;
                $user['email'] = $req->mail;
                $user['password'] = 'letmein';

                User::create($user);
                */

                User::insert([
                    'address_id' => $addressId,
                    'name' => $req->name,
                    'last_name' => $req->last_name,
                    'email' => $req->email,
                    'password' => '$2y$10$rNbFi625LejeDiIrcsMRaeCwnBSI1fo5IY4LZbvQh4NaGGIXwZeba',
                    'phone' => $req->phoneNumber,
                    'role' => 2,
                    'email_verified_at' => now(), // Optional: Set email_verified_at if you want to skip email verification
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

    public function store(Request $request): View
    {
        if (! empty($_POST['naam']) && ! empty($_POST['password'])) {
            $name = htmlspecialchars($_POST['email']);
            $pswd = htmlspecialchars($_POST['password']);

            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'laravel';

            $link = mysqli_connect($host, $user, $password) or exit('Error: No connection to the host');
            mysqli_select_db($link, $database) or exit('Error: no database found');

            $quer = "Select * From employees Where mail = '$name'";
            $res = mysqli_query($link, $quer);
            $row = mysqli_fetch_assoc($res);
            $ammount = mysqli_num_rows($res);
            if ($ammount > 0) {
                if ($pswd == $row['password']) {
                    $type = $row['jobTitle'];
                    $request->session()->put('name', $name);
                    $request->session()->put('Type', $type);

                    return view('/');
                } else {
                    return redirect()->back()->with('alert', 'Incorrect password!');
                }
            } else {
                return redirect()->back()->with('alert', 'Incorrect Username!');
            }
        } elseif (isset($_POST['submit']) && empty($_POST['naam']) && empty($_POST['password'])) {
            return redirect()->back()->with('alert', 'Empty Username and Password');
        }
    }

    public function searchEmployee(Request $req)
    {
        $query = $req->input('query');
        $employees = FacadesDB::select('select * from employees');

        $comboArray = [[]];
        $results = [[]];
        for ($i = 0; $i < count($employees); $i++) {
            $comboArray[$i][0] = $employees[$i]->id;
            $comboArray[$i][1] = $employees[$i]->user_id;
            $temp = FacadesDB::table('users')->where('id', $employees[$i]->user_id)->first();
            $comboArray[$i][2] = $temp->name;
            $comboArray[$i][3] = $temp->last_name;
            $comboArray[$i][4] = $temp->email;
            $comboArray[$i][5] = $employees[$i]->dateOfBirth;
            $comboArray[$i][6] = $employees[$i]->jobTitle;
            $comboArray[$i][7] = $employees[$i]->salary;
        }
        $b = 0;
        for ($i = 0; $i < count($comboArray); $i++) {
            $tempname = $comboArray[$i][2].' '.$comboArray[$i][3];
            if (strpos($tempname, $query) !== false) {
                $results[$b] = $comboArray[$i];
                $b += 1;
            }
        }

        return view('employee_view', ['employees' => $results]);
    }
}
?>


