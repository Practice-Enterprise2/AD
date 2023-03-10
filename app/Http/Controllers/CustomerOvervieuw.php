<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerOvervieuw extends Controller
{
    public function index()
{
    $customers = DB::table('customers')->get();

    return view('customers', [
        'customers' => $customers
    ]);
}

public function show($custID)
{
    $customer = DB::table('customers')->where('custID', $custID)->first();
    $address = DB::table('addresses')->where('addressID', $customer->addressID)->first();
    return view('customerDetails', [
        'customer' => $customer,
        'address' => $address,
    ]);
}

public function edit($custID)
{
    $customer = DB::table('customers')->where('custID', $custID)->first();
    $address = DB::table('addresses')->where('addressID', $customer->addressID)->first();
    return view('customerEdit', [
        'customer' => $customer,
        'address' => $address,
    ]);
}

public function update(Request $request, $custID)
{
    $customer = DB::table('customers')->where('custID', $custID)->first();

    $addressID = $customer->addressID;

    // Update the customer data
    DB::table('customers')->where('custID', $custID)->update([
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'email' => $request->input('email'),
        'phoneNr' => $request->input('phoneNr'),
    ]);

    // Update the address data
    DB::table('addresses')->where('addressID', $addressID)->update([
        'street' => $request->input('street'),
        'number' => $request->input('number'),
        'city' => $request->input('city'),
        'state' => $request->input('state'),
        'postal_code' => $request->input('postal_code'),
        'country' => $request->input('country'),
    ]);

    // Redirect the user back to the customer details page
    return redirect()->route('customer.show', $custID);
}


} 
