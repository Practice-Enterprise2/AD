<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class DepotoverviewController extends Controller
{
    public function Depotoverview() {
        $data = DB::table('depots')->get();
        if (Auth::user()){
            $name = Auth::user()->name;
        }else{
            $name = 'guest';
        }

        return view('depotoverview', ['data'=>$data, 'name' => $name]);
    }

    public function overviewperDepot(int $id) {
        $data = DB::table('depots')->get();
        
        return view('overviewperdepot', ['data' => $data, 'id' => $id]);

    }
}
