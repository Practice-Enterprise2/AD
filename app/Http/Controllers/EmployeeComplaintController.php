<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployeeComplaintController extends Controller
{
    public function sendComplaint(Request $req)
    {
        $firstname = $req->first_name;
        $lastname = $req->last_name;
        $email = $req->email;
        $jobtitle = $req->jobtitle;
        $location = $req->location;
        $shortDis = $req->shortDis;
        $discription = $req->discription;

        $this->validate($req, [
            'first_name' => ['nullable', 'alpha'],
            'last_name' => ['nullable', 'alpha'],
            'email' => ['nullable', 'email'],
            'jobtitle' => ['nullable', 'alpha'],
            'location' => ['nullable', 'string'],
            'shortDis' => ['required', 'string'],
            'discription' => ['required', 'string'],
        ]);

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'jobtitle' => $jobtitle,
            'location' => $location,
            'shortDis' => $shortDis,
            'discription' => $discription,
        ];

        Mail::send(['mail' => 'mail.test_mail'], $data, function ($message) use ($firstname, $lastname, $email, $jobtitle, $location, $shortDis, $discription) {
            $message->to('martinx1606@gmail.com')
                ->subject('complaint - '.$shortDis);
            $message->text("Discription of the incident:\n".$discription."\n\nlocation of the incident:\n".$location."\n\n\nfirstname: ".$firstname."\nlastname: ".$lastname."\nemail: ".$email."\njobtitle: ".$jobtitle);
        });

        return redirect()->route('home');
    }
}
