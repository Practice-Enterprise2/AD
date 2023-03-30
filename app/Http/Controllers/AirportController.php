<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Airport;


class AirportController extends Controller
{
    // GET Airports
    public function index() {
        $airports = DB::select('select * from airports');
        return view('AirportManagement', ['airports'=>$airports]);
    }
    
    // POST Airports
    function addData(Request $request)
    {
        $airports_old = new Airport;
        $airports_old->iata=$request->iata;
        $airports_old->name=$request->name;
        $airports_old->size=$request->size;
        $airports_old->tracks=$request->tracks;
        $airports_old->save();
        return redirect('addAirport');
    }

    // PUT Airports
    public function updateAirport(Request $request, $id) {
        $iata = $request->iata;
        $name = $request->name;
        $size = $request->size;
        $tracks = $request->tracks;

        DB:update("UPDATE `airports` SET `IATA` = 'BRU', `name` = 'Brussel airports', `address_id` = '14', `created_at` = NULL, `updated_at` = NULL WHERE `airports`.`id` = 1");
        DB::update("UPDATE `airports` SET `IATA` = '$iata', `name` = '$name', `size` = '$size', `tracks` = '$tracks' WHERE `airports`.`ID` = ?",[$id]);    
        return redirect('airport-management');
    }
    
    // DELETE Airports
    public function deleteAirport($ID) {
        DB::delete('delete from airports where IATA = ?', [$ID]);
        return redirect('/airport-management')->with('status',"Data Deleted Succesfully");
    }
}
