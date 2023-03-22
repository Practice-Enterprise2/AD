<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShipmentController extends Controller
{
    function index(){
        $shipments = DB::select('SELECT shipments.ShipmentName, shipments.ShipmentDate, shipmentstatus.Name
        FROM shipments
        JOIN shipmentstatus ON shipments.ShipmentID = shipmentstatus.StatusID');
        return view('shipments',['shipments'=>$shipments]);
    }
}
