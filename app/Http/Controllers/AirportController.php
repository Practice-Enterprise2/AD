<?php

namespace App\Http\Controllers;

use App\Models\airports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Foundation\Auth\Access\Authorizable;
use illuminate\Foundation\Validation\ValidatesRequests;
use Psy\Readline\Hoa\Console;

class AirportController extends Controller
{
    //
    function oldindex() 
    {
        return DB::select("SELECT * FROM airports_old");
    }
    public function index() {
        $airports = DB::select('select * from airports');
        return view('AirportManagement', ['airports'=>$airports]);
    }
    public function delete($id) {
        DB::delete('delete from airports where id = ?', [$id]);
        return redirect('/airport-management')->with('status',"Data Deleted Succesfully");
    }
    
}
