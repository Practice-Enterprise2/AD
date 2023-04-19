<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\airport;
use Illuminate\Http\Request;
use App\Models\Contract;
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
      /*  $test = new Contract;
        $test->airline_id = $request->airlineid;
        $test->creationdate = $request->creationdate;
        $test->expirationdate = $request->expirationdate;
        $test->price = $request->price;
        $test->airportID = $request->airportid;
        $test->departlocation = $request->departlocation;
        $test->destinationlocation = $request->destinationlocation;
        return view('new_contract',['data' => $data]);00 */
        $test = new Contract;
        $test->airline_id = $request["airlineid"];
        $test->start_date = $request["creationdate"];
        $test->end_date = $request["expirationdate"];
        $test->price = $request["price"];
        $test->airport_id = $request["airportid"];
        $test->depart_location = $request["departlocation"];
        $test->destination_location = $request["destinationlocation"];
        $test->save();
        $data = DB::select('select * from airlines');
        $airports = AirportController::getAirports();
        $airlines = Airline::all();
        return view('new_contract',compact('data','airports','airlines'));

    }
    function dropdown(){
        $data = DB::select('select * from airlines');
        $airports = AirportController::getAirports();
        $airlines = Airline::all();
        return view('new_contract',compact('data','airports','airlines'));
    }
}
