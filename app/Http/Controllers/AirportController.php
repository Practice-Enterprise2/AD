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
        $addItem->iata_code = $request->iata_code;
        $addItem->name = $request->name;
        $addItem->land = $request->land;
        $addItem->address_id = $request->address_id;

        $addItem->save();

        return redirect('airportList');
    }

    public function deleteAirport($id)
    {
        $data = airport::find($id);
        $data->delete();

        return redirect('airportList');
    }

    public function editAirport($id)
    {
        $data = airport::find($id);

        return view('editAirportList', ['data' => $data]);
    }

    public function updateAirport(Request $request)
    {
        $updateItem = airport::find($request->id);

        $updateItem->iata_code = $request->iata_code;
        $updateItem->name = $request->name;

        $updateItem->land = $request->land;
        $updateItem->address_id = $request->address_id;

        $updateItem->save();

        return redirect('airportList');
    }
}
