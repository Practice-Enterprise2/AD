<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShipmentController extends Controller
{
    function index(){
        $shipments = DB::select('SELECT shipments.name, shipments.shipment_date, shipments.delivery_date, shipmentstatus.Name
        FROM shipments
        INNER JOIN shipmentstatus ON shipments.status = shipmentstatus.StatusID
        ORDER BY shipments.id ASC');
        
        return view('shipments',['shipments'=>$shipments]);
    }

    public function showShipments_details($id){
        $shipments = DB::select("SELECT shipments.name, shipments.shipment_date, shipments.delivery_date, shipments.weight ,shipmentstatus.Name 
        FROM shipments
        INNER JOIN shipmentstatus ON shipments.status = shipmentstatus.StatusID WHERE id = '$id'");
        return view('shipments_details',['shipments'=>$shipments]);
    }
}
