<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\depots;

use Illuminate\Support\Facades\DB;
use illuminate\Foundation\Auth\Access\Authorizable;
use illuminate\Foundation\Validation\ValidatesRequests;
use Psy\Readline\Hoa\Console;

class DepotController extends Controller
{
    //
    function oldindex()
    {
        return DB::select("SELECT * FROM deports");

    }
    public function index() {
        $depots = DB::select('select * from depots');
        return view('DepotManagement', ['depots'=>$depots]);
    }
    public function deleteDepot($id) {
        DB::delete('delete from depots where id = ?', [$id]);
        return redirect('/depot-management')->with('status',"Data Deleted Succesfully");
    }

    // Edit Depot
    public function showDepotData($id)
    {
        $depots =  Depots::find($id);
        return view('editDepot', ['depots'=>$depots]);

    }
    public function updateDepot(Request $request, $id) {

        $code = $request->code;
        $location = $request->location;
        $size = $request->size;

      
        DB::update("UPDATE `depots` SET `code` = '$code', `location` = '$location', `size` = '$size' WHERE `depots`.`ID` = ?",[$id]);
        return redirect('depot-management');
    }

}
