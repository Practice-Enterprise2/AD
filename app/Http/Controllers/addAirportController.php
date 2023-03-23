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
        $airports_old->iata=$request->iata;
        $airports_old->name=$request->name;
        $airports_old->size=$request->size;
        $airports_old->tracks=$request->tracks;
        $airports_old->save();
        return redirect('addAirport');
    }
}
