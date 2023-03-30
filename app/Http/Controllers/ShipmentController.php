<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyPostmarkEmail;
use App\Mail\invoice;

class ShipmentController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function insertform()
    {
        return view('payment');
    }

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
        DB::insert('insert into shipments values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [null, $customerID, $ShipmentName, $sourceAddress, $AddressID, $shippingDate, $shippingDate, $ShipmentStatus, $expense, $ShipmentWeight, $ShipmentType, $current_date_time, $updated_date_time]);
        
        // Send email with Postmark
        $email = new MyPostmarkEmail();
        $email->to('r0902507@student.thomasmore.be')
              ->subject('New shipment')
              ->html('<p>A new shipment has been created. This is the invoice.</p>');
        Mail::send($email);

    }

}
