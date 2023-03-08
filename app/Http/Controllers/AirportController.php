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
    public function deleteAirport($id) {
        DB::delete('delete from airports where id = ?', [$id]);
        return redirect('/airport-management')->with('status',"Data Deleted Succesfully");
    }
    public function editAirport($id) {
        $airports = Airports::find($id);
        return view('EditAirport', compact('airports'));
    }
    
    // Edit Airport
    public function showData($id)
    {
        $airports =  Airports::find($id);
        return view('EditAirport', ['airports'=>$airports]);

    }
    public function updateAirport(Request $request, $id) {
        $airport = Airports::find($id);
        $airport->name = $request->name;
        $airport->location = $request->location;
        $airport->size = $request->size;
        $airport->owner = $request->owner; 
        $airport->save();

        $name = $request->name;
        $location = $request->location;
        $size = $request->size;
        $owner = $request->owner;

        // DB::update("update airports set `name` = Cop , `location` = 'Zavente', `size` = '124', `owner` = 'BA' WHERE `airports`.`ID` = 2",[$name]);
        DB::update("UPDATE `airports` SET `name` = '$name', `location` = '$location', `size` = '$size', `owner` = '$owner' WHERE `airports`.`ID` = ?",[$id]);
        return redirect('airport-management');
    }


    
}
