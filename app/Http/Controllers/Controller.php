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
        return view('shipmentsOverview',['shipments'=>$shipments]);
    }

    public function showShipments_details($id){
        $shipments = DB::select("select * from shipments WHERE id = '$id'");
        return view('shipments_details_overview',['shipments'=>$shipments]);
    }

    public function indexSorting()
{
    $shipments = shipment::sortable()->paginate(20);

    return view('shipmentsOverview')->with('shipments', $shipments);
}
}


