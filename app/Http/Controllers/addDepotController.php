<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\depots;

class addDepotController extends Controller
{
    //
    function addData(Request $request)
    {
        $airports_old = new depots;
        $airports_old->code=$request->code;
        $airports_old->location=$request->location;
        $airports_old->size=$request->size;
        $airports_old->save();
        return redirect('addDepot');
    }
}
