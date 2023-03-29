<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testmodel;
use Illuminate\Support\Facades\DB;

class newcontractcontroller extends Controller
{
    function plaats(Request $request){
        
        $request->validate([
            'airlineid' => 'required',
            'creationdate' => 'required',
            'expirationdate' => 'required',
            'price' => 'required|integer',
            'airportid' => 'required',
            'departlocation' => 'required',
            'destinationlocation' => 'required',

        ],
        [
            'airlineid.required'=>'The AirlineID field is required.',
            'airportid.required'=>'The AirportID field is required.',

        ]);
        $test = new testmodel;
        $test->airlineID = $request->airlineid;
        $test->creationdate = $request->creationdate;
        $test->expirationdate = $request->expirationdate;
        $test->price = $request->price;
        $test->airportID = $request->airportid;
        $test->departlocation = $request->departlocation;
        $test->destinationlocation = $request->destinationlocation;
        $test->save();
        return view('test');
    }
    function dropdown(){
        $data = DB::select('select * from airlines');
        return view('new_contract',['data' => $data]);
    }
}
