<?php

namespace App\Http\Controllers;

use aPP\Models\shipment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class shipmentController extends Controller
{
    //INSERT INTO `shipments` (`id`, `CustomerID`, `name`, `source_address_id`, `destination_address_id`, `shipment_date`, `delivery_date`, `status`, `expense`, `weight`, `type`, `created_at`, `updated_at`) VALUES ('1', '1', 'USER', '1', '2', '2023-03-01', '2023-03-10', '1', '100', '200', 'plane', NULL, NULL);
    public function addStaticSchip(Request $request) {
        $CustomerID = 1;
        $name = 'USER';
        $srcAdID = 1;
        $dstAdID = 2;
        $shipDate = '2023-03-01';
        $delDate = '2023-03-10';
        $status = 1;
        $expense = 100;
        $weight = 200;
        $type = 'plane';

        // table for saviong t en t codes?
        $tandTcode = rand(1, 10000);

        $data=array('CustomerID'=>$CustomerID,"name"=>$name,"source_address_id"=>$srcAdID, "destination_address_id"=>$dstAdID,"shipment_date"=>$shipDate,"delivery_date"=>$delDate,"status"=>$status,"expense"=>$expense,"weight"=>$weight,"type"=>$type);
        DB::table('shipments')->insert($data);
        echo "Your T&T code: ".$tandTcode;
    }
    
}
