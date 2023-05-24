<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Airline;
use Illuminate\Http\Request;
use DB;

date_default_timezone_set('Europe/Brussels');

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = DB::select('select * from airlines');
        if (Auth::user()!=null ){
            
            $name = Auth::user()->name;

            return view('airlineoverview', ['airlines' => $airlines, 'name' => $name]);
        } else {
            return view('airlineoverview',['airlines' => $airlines, 'name' => $name]);
        }
         
    }

    public function overviewperAirline(int $id)
    {
        $data = DB::select('select * from airlines where id= ?',[$id]);

        return view('overviewperairline', ['data' => $data, 'id' => $id]);
    }

    public function addAirlinepage()
    {   
        
        return view('addAirline');
            
                
    }

    public function addAirline(Request $request)
    {
        DB::insert('insert into airlines values(?, ?, ?, ?, ?, ?)', [null, $request->name, $request->price, now(), null, null]);

        header('Location: /airlineoverview');
        exit();
    }

    public function editAirlinepage(int $id)
    {
        
        $airlines = DB::select('select * from airlines where id = ?', [$id]);

        return view('editAirline', ['airlines' => $airlines]);

    }

    public function editAirline(Request $request, int $id)
    {
        DB::insert('UPDATE airlines set name = ?, price = ?, updated_at = ? where id = ?', [$request->name, $request->price, now(), $id]);

        header('Location: /airlineoverview');
        exit();
    }

    public function Deleteairline($id)
    {

        Airline::where('id', [$id])->delete();

        header('Location: /airlineoverview');
        exit();
    }   
}
