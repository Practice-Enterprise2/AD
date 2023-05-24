<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\airport;
use Illuminate\Support\Facades\DB;

class NewContractController extends Controller
{
    public function plaats(Request $request)
    {
        
        $request->validate([
            'airlineid' => 'required',
            'creationdate' => 'required|date|after_or_equal:today',
            'expirationdate' => 'required|date|after:start_date',
            'price' => 'required|numeric',
            'departlocation' => 'required',
            'destinationlocation' => 'required',
        ], [
            'airlineid.required' => 'The AirlineID field is required.',
            'creationdate.required' => 'The StartDate field is required.',
            'creationdate.date' => 'The StartDate must be a valid date.',
            'creationdate.after_or_equal' => 'The Creation Date must be today or in the future.',
            'expirationdate.required' => 'The EndDate field is required.',
            'expirationdate.date' => 'The EndDate must be a valid date.',
            'expirationdate.after' => 'The Expiration Date must be after the Start Date.',
            'price.required' => 'The Price field is required.',
            'price.numeric' => 'The Price must be a numeric value.',
            'departlocation.required' => 'The Departure Location field is required.',
            'destinationlocation.required' => 'The Destination Location field is required.',
        ]);
        $test = new Contract;
        $test->airline_id = $request['airlineid'];
        $test->start_date = $request['creationdate'];
        $test->end_date = $request['expirationdate'];
        $test->price = $request['price'];
        $test->depart_airport_id = $request['departlocation'];
        $test->destination_airport_id = $request['destinationlocation'];
        $test->created_at = Carbon::now();
        $test->is_active = true;
        $test->save();
        $data = DB::select('select * from airlines');
        $airports = airport::all();
        $airlines = Airline::all();

        return view('new_contract', compact('data', 'airports', 'airlines'));
    }

    public function dropdown()
    {
        $data = DB::select('select * from airlines');
        $airports = airport::all();
        $airlines = Airline::all();

        return view('new_contract', compact('data', 'airports', 'airlines'));
    }
}
