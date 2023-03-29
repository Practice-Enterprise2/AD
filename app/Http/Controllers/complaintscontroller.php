<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class complaintscontroller extends Controller
{
    public function messages(){
        return view('complaints.messages');
    }
}
