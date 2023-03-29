<?php

namespace App\Http\Controllers;

class PickupController extends Controller
{
    public function create()
    {
        return view('create-pickup');
    }
}
