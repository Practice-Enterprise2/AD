<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\airports;


class addAirportController extends Controller
{
    //
    function addData(Request $request)
    {
        $airports_old = new airports;
        $airports_old->name=$request->name;
        $airports_old->location=$request->location;
        $airports_old->size=$request->size;
        $airports_old->owner=$request->owner;
        $airports_old->save();
        return redirect('addAirport');
    }
}
