<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $vehicle = Vehicle::all();

        return view('vehicle.index')->with('vehicle', $vehicle);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Vehicle::create($input);

        return redirect('vehicle')->with('flash_message', 'Vehicle Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $vehicle = Vehicle::find($id);

        return view('vehicle.show')->with('vehicle', $vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $vehicle = Vehicle::find($id);

        return view('vehicle.edit')->with('vehicle', $vehicle);

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $vehicle = vehicle::find($id);
        $input = $request->all();
        $vehicle->update($input);

        return redirect('vehicle')->with('flash_message', 'vehicle Updated!');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
            $vehicle = vehicle::find($id);
            $vehicle->update(['deleted' => True]);
            return redirect('vehicle')->with('flash_message', 'vehicle deleted!');
    

    }

}
