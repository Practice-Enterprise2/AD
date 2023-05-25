<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{

    public function airportFiltering(Request $request)
    {
        $filter = $request->query('filter');

        if (! empty($filter)) {
            $airports = airport::sortable()
                ->where('name', 'like', '%'.$filter.'%')
                ->paginate(10);
        } else {
            $airports = airport::sortable()
                ->paginate(10);
        }

        return view('/airportList', ['airports' => $airports]);
    }

    // GET Airports
    public function index()
    {
        $airports = DB::select('select * from airports');

        return view('AirportManagement', ['airports' => $airports]);
    }
    public function getAirports()
    {
        $airports = Airport::all();

        return $airports;
    }
    // POST Airports
    public function addData(Request $request)
    {
        $airports_old = new Airport;
        $airports_old->iata = $request->iata;
        $airports_old->name = $request->name;
        $airports_old->size = $request->size;
        $airports_old->tracks = $request->tracks;
        $airports_old->save();

        return redirect('addAirport');
    }

    // PUT Airports
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

    public function editAirport($id)
    {
        $data = airport::find($id);

        return view('editAirportList', ['data' => $data]);
    }

    // DELETE Airports
    public function deleteAirport($ID)
    {
        DB::delete('delete from airports where ID = ?', [$ID]);

        return redirect('airportList')->with('status', 'Data Deleted Succesfully');
    }

}
