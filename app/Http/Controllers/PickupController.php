<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pickup_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int|null $shipment_id = null): View
    {
        return view('pickup_creation_form', [
            'shipment_id' => $shipment_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): string
    {
        return "Requested Pickup $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $pickup_id): View
    {
        return view('pickup_edit', [
            'pickup_id' => $pickup_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
    }
}
