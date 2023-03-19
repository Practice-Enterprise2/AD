<?php

namespace App\Http\Controllers;

use App\Models\shipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;

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

    public function indexSorting()
{
    $shipments = shipment::sortable()->paginate(20);

    return view('shipments')->with('shipments', $shipments);
}
}


