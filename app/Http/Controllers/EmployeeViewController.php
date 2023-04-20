<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Address;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class EmployeeViewController extends Controller
{
    public function showAdd()
    {
        return view("add_employee");
    }
    public function employeeEdit(){
        
        $idforedit = $_POST["employeeId"];
        return view("employee_edit", ['theid' => $idforedit]);

    }
    public function index(): View|Factory
    {
        $employees = FacadesDB::select('select * from employees');
        $users = FacadesDB::select('select * from users');
        $address = FacadesDB::select('select * from addresses');

        $comboArray = array(array());
        for($i = 0; $i<count($employees); $i++)
        {
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
                $user = new Employee();
                $user2 = new User();
                $address = new Address();
                $user2->name = $req->firstName;
                $user2->last_name = $req->lastName;
                $address->street = $req->street;
                $address->house_number = $req->houseNumber;
                $address->region = $req->province;
                $address->city = $req->city;
                $address->postal_code = $req->postalCode;
                $address->country = $req->country;
                //$user->phoneNumber = $req->phoneNumber;
                $user2->email = $req->mail;
                $user->dateOfBirth = $req->dateOfBirth;
                //$user->isActive = $req->isActive;
                $user->jobTitle = $req->jobTitle;
                $user->salary = $req->salary;
                $user2->password = $req->password;
                $user->iban = $req->Iban;
                
                
                $address->save();
                $id1 = FacadesDB::table('addresses')->where('street', $req->street)->where('house_number', $req->houseNumber)->where('city', $req->city)->value('id');
                
                $user2->address_id = $id1;
                $user2->save();
                $id2 = FacadesDB::table('users')->where('email', $req->mail)->value('id');;
                
                $user->user_id = $id2;
                
                $user->save();
                return redirect()->back()->with('alert', 'complete creation');
            }
        }

        return redirect()->back()->with('alert', 'Invalid IBAN!');
    }

    public function store(Request $request): View|Factory
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
}
?>
    

