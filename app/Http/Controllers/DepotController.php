<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function delete($id) {
        DB::delete('delete from depots where id = ?', [$id]);
        return redirect('/depot-management')->with('status',"Data Deleted Succesfully");
    }
    
}
