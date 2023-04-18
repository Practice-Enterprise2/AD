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
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;



// User Actions
// User creates Shipment
class ShipmentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function insert(Request $request)
    {
        // Get Address data from form
        $ShipmentStreet = $request->input('Street');
        $ShipmentHouseNr = $request->input('HouseNr');
        $ShipmentPostalCode = $request->input('PostalCode');
        $ShipmentCity = $request->input('City');
        $ShipmentRegion = $request->input('Region');
        $ShipmentCountry = $request->input('Country');
        $current_date_time = date('Y-m-d H:i:s');
        $updated_date_time = date('Y-m-d H:i:s');
        // Put Address data in Address table
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
        $customerID = 2;
        //$sourceAddress = DB::select('select address_id from customers where id = ?',[1]);
        $sourceAddress = 1;
        DB::insert('insert into shipments values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $ShipmentName, $sourceAddress, $AddressID, $shippingDate, $shippingDate, $ShipmentStatus, $expense, $ShipmentWeight, $ShipmentType, $current_date_time, $updated_date_time, 0, null]);
        
        

        // Get data to show new shipment in overview page
        $id = DB::table('shipments')->latest()->value('id');
        $data = Shipment::find($id); 
        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);
        
        // Navigate to overview page of new shipment
        // Add tracknTrace stuSff in it
        return view('shipmentOverview', ['data' => $data], ['srcAddress' => $address1,'dstAddress' => $address2]);
      
    }

    // Get the data per user
    public function getShipmentPerUser() 
    {
        $id = Auth::user()->id;
        $userName = Auth::user()->name;
        // $id = 1;
        $shipment = DB::table('shipments')
        ->join('addresses','shipments.destination_address_id', '=', 'addresses.id')
        ->where('shipments.user_id', $id)
        ->select('shipments.name','shipments.id', 'addresses.street', 'addresses.house_number', 'addresses.postal_code', 'addresses.city', 'addresses.region', 'addresses.country', 'shipments.shipment_date','shipments.delivery_date', 'shipments.status')
        ->get();



        return view('shipmentPerUser', ['shipment' => $shipment], ['username' => $userName]);
        // return view('ShipmentPerUser', ['user' => $user]);
    }

    public function getShipmentInfo($id) 
    {
    
        $data = Shipment::find($id); 
        $address1 = Address::find($data->source_address_id);
        $address2 = Address::find($data->destination_address_id);
        
        // Navigate to overview page of new shipment
        // Add tracknTrace stuSff in it
        return view('shipmentOverview', ['data' => $data], ['srcAddress' => $address1,'dstAddress' => $address2]);
    }

}


