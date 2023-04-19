<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Europe/Brussels');

class DepotController extends Controller
{
    // GET Depots
    public function index() {
        $depots = DB::select('select * from depots');
        if (Auth::user()){
            $name = Auth::user()->name;
        }else{
            $name = 'guest';
        }
        return view('depotManagement', ['depots'=>$depots, 'name' => $name]);
    }

    public function overviewperDepot(int $id) {
        $data = DB::select('select d.*, a.street, a.house_number, a.postal_code,a.city,a.region,a.country from addresses a RIGHT join depots d on a.id = d.addressid');
        
        return view('overviewperdepot', ['data' => $data, 'id' => $id]);

    }

    public function addDepotpage() {
        return view('addDepot');
    }

    public function addDepot(Request $request) {

        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = null;
        DB::insert('insert into addresses values(?, ?, ?, ?, ?, ?, ?,?,?)', [null, $request->street, $request->house_number, $request->postal_code, $request->city, $request->region, $request->country, $current_date_time, $updated_date_time]);
        $addressID = DB::getPdo()->lastInsertId();
        DB::insert('insert into depots values(?, ?,?, ?, ?, ?, ?)', [null, $request->code, $addressID, $request->size, $request->filled, $current_date_time, $updated_date_time]);
    
        header("Location: /DepotManagement");
        die();
    }

    public function editDepotpage(int $id) {
        $depots = DB::select('select * from depots where id = ?', [$id]);
        return view('editDepot', ['depots'=>$depots]);
    }

    public function editDepot(Request $request, int $id) {
        $updated_date_time = date('Y-m-d H:i:s');
        DB::insert('UPDATE depots set code = ?, addressid = ?, size = ?, amountFilled = ?, updated_at = ? where id = ?', [$request->code,$request->addressid, $request->size, $request->filled, $updated_date_time, $id]);
    
        header("Location: /DepotManagement");
        die();
    }

    // POST depot 
    /*
    public function insertDepo(Request $request) {
        $depotStreet = $request->input('');
        $depotHouseNumber = $request->input('');
        $depotPostalCode = $request->input('');
        $depotCity = $request->input('');
        $depotRegion = $request->input('');
        $depotCountry = $request->input('');
        
        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = null;
        DB::insert('insert into addresses values(?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $depotStreet, $depotHouseNumber, $depotPostalCode, $depotCity, $depotRegion, $depotCountry, $current_date_time, $updated_date_time]);

        $depotAddressID =  DB::getPdo()->lastInsertId();
        $depotCode = $request->input('');
        $depotSize = $request->input('');
        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = null;
        DB::insert('insert into depots values(?, ?, ?, ?, ?, ?)', [null, $depotCode, $depotAddressID, $depotSize, $current_date_time, $updated_date_time]);
    }
    */
    // PUT depot
    // Needs to change with the address table and new fields.

    // DELETE depot
    // Not soft delete yet!!!
    public function deleteDepot($id) {
        DB::delete('delete from depots where id = ?', [$id]);
        return $this->index()->with('status',"Data Deleted Succesfully");
    }
}