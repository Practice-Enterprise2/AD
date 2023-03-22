<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class employeeComplaintsController extends Controller
{
    function sendComplaint(Request $req)
    {   
        $firstname = $req->first_name;
        $lastname = $req->last_name;
        $email = $req->email;
        $jobtitle = $req->jobtitle;
        $location = $req->location;
        $shortDis = $req->shortDis;
        $discription = $req->discription;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'jobtitle' => $jobtitle,
            'location' => $location,
            'shortDis' => $shortDis,
            'discription' => $discription
        ];

        Mail::send(['mail'=>'mail.test_mail'], $data, function($message) use ($firstname, $lastname, $email, $jobtitle, $location, $shortDis, $discription) {
            $message->to('hr-complaints@BlueSky.com')
                    ->subject('complaint - '.$shortDis);
            if ($firstname != null || $lastname != null || $email != null || $jobtitle != null)
            {
                $message->text("Discription of the incident:\n".$discription."\n\nlocation of the incident:\n".$location."\n\n\nfirstname: ".$firstname."\nlastname: ".$lastname."\nemail: ".$email."\njobtitle: ".$jobtitle);
            }
            else
            {
                $message->text("Location of the incident:\n".$location."\n\nDiscription of the incident:\n".$discription);
            }
        });

        return redirect()->back();
    }
}
