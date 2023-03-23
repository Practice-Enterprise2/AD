<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShipmentController extends Controller
{
    function index(){
        $shipments = DB::select('SELECT shipments.ShipmentName, shipments.ShipmentDate, shipments.DeliveryDate, shipmentstatus.Name
        FROM shipments
        INNER JOIN shipmentstatus ON shipments.ShipmentStatus = shipmentstatus.StatusID
        ORDER BY shipments.ShipmentID ASC');
        
        return view('shipments',['shipments'=>$shipments]);
    }

    public function showShipments_details($id){
        $shipments = DB::select("SELECT shipments.ShipmentName, shipments.ShipmentDate, shipments.DeliveryDate, shipments.ShipmentWeight ,shipmentstatus.Name 
        FROM shipments
        INNER JOIN shipmentstatus ON shipments.ShipmentStatus = shipmentstatus.StatusID WHERE ShipmentID = '$id'");
        return view('shipments_details',['shipments'=>$shipments]);
    }
}
