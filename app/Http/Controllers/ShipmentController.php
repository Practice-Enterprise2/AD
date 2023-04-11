<?php

namespace App\Http\Controllers;

use App\Mail\shipmentMail;
use App\Models\Address;
use Illuminate\Support\Facades\Mail;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;


class ShipmentController extends Controller
{
    //
    use AuthorizesRequests, ValidatesRequests;
    public function insert(Request $request)
    {
        $ShipmentStreet = $request->input('Street');
        $ShipmentHouseNr = $request->input('HouseNr');
        $ShipmentPostalCode = $request->input('PostalCode');
        $ShipmentCity = $request->input('City');
        $ShipmentRegion = $request->input('Region');
        $ShipmentCountry = $request->input('Country');
        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = date('Y-m-d H:i:s');
        DB::insert('insert into addresses values(?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $ShipmentStreet, $ShipmentHouseNr, $ShipmentPostalCode, $ShipmentCity, $ShipmentRegion, $ShipmentCountry, $current_date_time, $updated_date_time]);
        $AddressID = DB::getPdo()->lastInsertId();
        $ShipmentName = $request->input('FirstName') . ' ' . $request->input('LastName');
        $ShipmentStatus = 1;
        $ShipmentWeight = $request->input('Weight');
        $ShipmentType = $request->input('Type');
        $shippingDate = $request->input('shippingDate');
        if ($ShipmentType == 1) {
            $expense = 5;
        } else {
            $expense = 10;
        }
        $customerID = 1;
        //$sourceAddress = DB::select('select address_id from customers where id = ?',[1]);
        $sourceAddress = DB::table('customers')->where('id', $customerID)->value('address_id');
        DB::insert('insert into shipments values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $customerID, $ShipmentName, $sourceAddress, $AddressID, $shippingDate, $shippingDate, $ShipmentStatus, $expense, $ShipmentWeight, $ShipmentType, $current_date_time, $updated_date_time, 0, null]);
        
        // Mail::to('killian.serluppens@gmail.com')->send(new shipmentMail());

        $id = DB::table('shipments')->latest()->value('id');
        
        $data = Shipment::find($id);

        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);
        

        return view('shipmentOverview', ['data' => $data], ['srcAddress' => $address1,'dstAddress' => $address2]);
      
    }

    public function getShipmentInfo($id) {
        $data = Shipment::find($id);


        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);
        

        return view('/shipmentOverview/', ['data' => $data], ['srcAddress' => $address1,'dstAddress' => $address2]);

    }
}
