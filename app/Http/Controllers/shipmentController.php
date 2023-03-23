<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class shipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('shipment.index', [
            'shipments' => Shipment::where('customer_id', Auth::user()->id)->get()
        ]);
    }

    public function AjaxShipment(Request $request)
    {   
        return view('shipment.ajax-shipment', [
            'shipments' => Shipment::where('customer_id', Auth::user()->id)->where('status', $request->status)->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('shipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'from_name' => 'required',
            'from_phone' => 'required|min:8|max:11|regex:/^([0-9\s\-\+\(\)]*)$/',
            'from_address' => 'required',
            'from_postalcode' => 'required|numeric',
            'from_city'=>'required',
            'from_country' => 'required',
            'to_name' => 'required',
            'to_phone' => 'required|min:8|max:11|regex:/^([0-9\s\-\+\(\)]*)$/',
            'to_address' =>'required',
            'to_postalcode' => 'required|numeric',
            'to_city'=>'required',
            'to_country' => 'required',
            'weight' => 'required|numeric',
            'package_num' => 'required|numeric',
        ]);

        Shipment::create([
            'customer_id' => Auth::user()->id,
            'from_name' => $request->from_name,
            'from_phone' => $request->from_phone,
            'from_address' => $request->from_address,
            'from_postalcode' => $request->from_postalcode,
            'from_city'=>$request->from_city,
            'from_country' => $request->from_country,
            'to_name' => $request->to_name,
            'to_phone' => $request->to_phone,
            'to_address' => $request->to_address,
            'to_postalcode' => $request->to_postalcode,
            'to_city'=>$request->to_city,
            'to_country' => $request->to_country,
            'weight' => $request->weight,
            'package_num' => $request->package_num,
            'price' => 100,
        ]);
        return Redirect(route('shipment.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $shipment = Shipment::where('id', $id)->first();
        if(Shipment::where('id', $id)->exists() && $shipment->customer_id == Auth::user()->id)
        {
        return view('shipment.show', [
            'shipment' => $shipment
        ]);
        }
        else
        {
            return redirect(route('shipment.index'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $shipment = Shipment::where('id', $id)->first();
        if(Shipment::where('id', $id)->exists() && $shipment->customer_id ==  Auth::user()->id)
        {
        return view('shipment.show', [
            'shipment' => $shipment
        ]);
        }
        else
        {
            return redirect(route('shipment.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $package = Shipment::where('id', $id)->first();
        if(!Shipment::where('id', $id)->exists() && $package->status > 0 && $package->status < 3 && $package->customer_id != Auth::user()->id)
        {
            return redirect(route('shipment.index'));
        }
        Shipment::destroy($id);
        return redirect(route('shipment.index'));


    }
}
