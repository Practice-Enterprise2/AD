<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class AirlineController extends Controller
{
    public function Airlineoverview()
    {
        $data = DB::table('airlines')->get();
        if (Auth::user()) {
            $name = Auth::user()->name;
        } else {
            $name = 'guest';
        }

        return view('Airlineoverview', ['data' => $data, 'name' => $name]);
    }

    public function overviewperAirline(int $id)
    {
        $data = DB::table('airlines')->get();

        return view('overviewperairline', ['data' => $data, 'id' => $id]);

    }
}
