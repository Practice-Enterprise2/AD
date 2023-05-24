<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Europe/Brussels');

class DepotController extends Controller
{

    // GET Depots
    public function index()
    {
        $depots = DB::select('select * from depots');
        if (Auth::user()!=null ){
            
            $name = Auth::user()->name;

            return view('depotManagement', ['depots' => $depots, 'name' => $name]);
        } else {
            return view('depotManagement',['depots' => $depots, 'name' => $name]);
        }
         
    }

    public function overviewperDepot(int $id)
    {
        $data = DB::select('select d.*, a.street, a.house_number, a.postal_code,a.city,a.region,a.country from addresses a RIGHT join depots d on a.id = d.addressid');

        return view('overviewperdepot', ['data' => $data, 'id' => $id]);
    }

    public function addDepotpage()
    {   
        
        return view('addDepot');
            
                
    }

    public function addDepot(Request $request)
    {
        DB::insert('insert into addresses values(?, ?, ?, ?, ?, ?, ?, ?,?)', [null, $request->street, $request->house_number, $request->postal_code, $request->city, $request->region, $request->country, now(), null]);
        $addressID = DB::getPdo()->lastInsertId();
        DB::insert('insert into depots values(?, ?,?, ?, ?, ?, ?, ?)', [null, $request->code, $addressID, $request->size, $request->filled, now(), null, null]);

        header('Location: /DepotManagement');
        exit();
    }

    public function editDepotpage(int $id)
    {
        
        $depots = DB::select('select * from depots where id = ?', [$id]);

        return view('editDepot', ['depots' => $depots]);

    }

    public function editDepot(Request $request, int $id)
    {
        DB::insert('UPDATE depots set code = ?, addressid = ?, size = ?, amountFilled = ?, updated_at = ? where id = ?', [$request->code, $request->addressid, $request->size, $request->filled, now(), $id]);

        header('Location: /DepotManagement');
        exit();
    }

    public function deleteDepot($id)
    {

        Depot::where('id', [$id])->delete();

        header('Location: /DepotManagement');
        exit();
    }
}
