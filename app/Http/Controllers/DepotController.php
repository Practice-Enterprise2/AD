<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DepotController extends Controller
{
    // GET Depots
    public function index() {
        $depots = DB::select('select * from depots');
        return view('DepotManagement', ['depots'=>$depots]);
    }

    // POST depot
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

    // PUT depot
    // Needs to change with the address table and new fields.

    // DELETE depot
    // Not soft delete yet!!!
    public function deleteDepot($id) {
        DB::delete('delete from depots where id = ?', [$id]);
        return redirect('/depot-management')->with('status',"Data Deleted Succesfully");
    }
}
