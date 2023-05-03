<?php

namespace App\Http\Controllers;

use App\Models\airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function airportFiltering(Request $request)
    {
        $filter = $request->query('filter');

        if (! empty($filter)) {
            $airports = airport::sortable()
                ->where('name', 'like', '%'.$filter.'%')
                ->paginate(15);
        } else {
            $airports = airport::sortable()
                ->paginate(15);
        }

        return view('airportList', ['airports' => $airports]);
    }

    public static function getAirports()
    {
        $airports = airport::all();

        return $airports;
    }

    public function addAirport(Request $request)
    {
        $addItem = new airport;
        $addItem->airportName = $request->airportName;
        $addItem->iataCode = $request->iataCode;
        $addItem->stateCode = $request->stateCode;
        $addItem->countryCode = $request->countryCode;
        $addItem->countryName = $request->countryName;

        $addItem->save();

        return redirect('airportList');
    }

    public function deleteAirport($iataCode)
    {
        $data = airport::find($iataCode);
        $data->delete();

        return redirect('airportList');
    }

    public function editAirport($iataCode)
    {
        $data = airport::find($iataCode);

        return view('editAirportList', ['data' => $data]);
    }

    public function updateAirport(Request $request)
    {
        $updateItem = airport::find($request->iataCode);

        $updateItem->airportName = $request->airportName;

        $updateItem->stateCode = $request->stateCode;
        $updateItem->countryCode = $request->countryCode;
        $updateItem->countryName = $request->countryName;

        $updateItem->save();

        return redirect('airportList');
    }
}