<?php

namespace App\Http\Controllers;

use App\Models\airports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Foundation\Auth\Access\Authorizable;
use illuminate\Foundation\Validation\ValidatesRequests;
use PDO;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Input\Input;

class AirportController extends Controller
{
    //
    function oldindex() 
    {
        return DB::select("SELECT * FROM airports");
    }
    public function index() {
        $airports = DB::select('select * from airports');
        return view('AirportManagement', ['airports'=>$airports]);
    }
    public function deleteAirport($ID) {
        DB::delete('delete from airports where IATA = ?', [$ID]);
        return redirect('/airport-management')->with('status',"Data Deleted Succesfully");
    }
    public function editAirport($iata) {
        $airports =  DB::select('SELECT * FROM `airports` WHERE `IATA` = ?',[$iata]);    
        return view('EditAirport', compact('airports'));
    }
    
    // Edit Airport
    public function showData($id)
    {
        $airports = Airports::find($id);
        return view('EditAirport', ['airports'=>$airports]);
    }
    public function updateAirport(Request $request, $id) {
        $iata = $request->iata;
        $name = $request->name;
        $size = $request->size;
        $tracks = $request->tracks;

        DB::update("UPDATE `airports` SET `IATA` = '$iata', `name` = '$name', `size` = '$size', `tracks` = '$tracks' WHERE `airports`.`ID` = ?",[$id]);    
        return redirect('airport-management');
    }


    
}
