<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\airport;

class AirportController extends Controller
{
    function show()
    {
        $data = \App\Models\airport::paginate(10);
        return view('airportList', ['airports' => $data]);
    }
    public static function getAirports()
    {
       $airports = airport::all();
       return $airports	;
    }
    function addAirport(Request $request)
    {
        $addItem = new airport;
        $addItem->airportName = $request->airportName;
        $addItem->iataCode = $request->iataCode;
        $addItem->stateCode = $request->stateCode;
        $addItem->countryCode = $request->countryCode;
        $addItem->countryName = $request->countryName;

        // add boolean and integers to DB
        // $addItem->airportInUse = $request->boolean(key: 'usageCheckbox');
        // $addItem->Tariff = $request->tariffAmount;

        $addItem->save();
        return redirect('airportList');
    }

    function deleteAirport($iataCode)
    {
        $data = airport::find($iataCode);
        $data->delete();
        return redirect('airportList');
    }

    function editAirport($iataCode)
    {
        $data = airport::find($iataCode);
        return view('editAirportList', ['data' => $data]);
    }

    function updateAirport(Request $request)
    {
        $updateItem = airport::find($request->iataCode);

        $updateItem->airportName = $request->airportName;

        // Don't update primary key
        // $updateItem->iataCode = $request->iataCode;
        $updateItem->stateCode = $request->stateCode;
        $updateItem->countryCode = $request->countryCode;
        $updateItem->countryName = $request->countryName;

        // update boolean and int
        // $updateItem->airportInUse = $request->boolean(key: 'usageCheckbox');
        // $updateItem->Tariff = $request->tariffAmount;

        $updateItem->save();
        return redirect('airportList');
    }
}
?>
