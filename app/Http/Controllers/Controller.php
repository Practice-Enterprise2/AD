<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showShipments(){
        $shipments = DB::select('select * from shipments');
        return view('shipments',['shipments'=>$shipments]);
    }

    public function showShipments_details($id){
        $shipments = DB::select("select * from shipments WHERE ShipmentID = '$id'");
        return view('shipments_details',['shipments'=>$shipments]);
    }
}
