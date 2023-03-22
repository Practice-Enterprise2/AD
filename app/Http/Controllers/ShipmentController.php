<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShipmentController extends Controller
{
    function index(){
        $shipments = DB::select('SELECT shipments.ShipmentName, shipments.ShipmentDate, shipmentstatus.Name
        FROM shipments
        INNER JOIN shipmentstatus ON shipments.ShipmentStatus = shipmentstatus.StatusID
        ORDER BY shipments.ShipmentID ASC');
        
        return view('shipments',['shipments'=>$shipments]);
    }
}
