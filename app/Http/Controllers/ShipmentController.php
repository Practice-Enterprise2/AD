<?php

namespace App\Http\Controllers;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::where('CustomerID', auth()->id())->get();
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('shipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_address_id' => 'required',
            'destination_address_id' => 'required',
            'shipment_date' => 'required',
            'delivery_date' => 'required',
            'status' => 'required',
            'expense' => 'required',
            'weight' => 'required',
            'type' => 'required',
        ]);

        $CustomerID = auth()->id();
        $id = Shipment::max('id') + 1;
        $CustomerName = auth()->user()->name;
        $request->merge(['id' => $id, 'CustomerID' => $CustomerID, 'name' => $CustomerName]);

        Shipment::create($request->all());

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment created successfully.');
    }

    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }
    
    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'source_address_id' => 'required',
            'destination_address_id' => 'required',
            'shipment_date' => 'required',
            'delivery_date' => 'required',
            'status' => 'required',
            'expense' => 'required',
            'weight' => 'required',
            'type' => 'required',
        ]);
        $shipment->update($request->all());

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }

}
