<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function create(Request $request): View
    {
        $shipment_id = $request->input('shipment_id');

        if ($shipment_id != null) {
            $shipment_id = (int) $shipment_id;

            if ($shipment_id == null) {
                abort(Response::HTTP_BAD_REQUEST, 'The request contains an invalid shipment id');
            }
        }

        return view('pickup_creation_form', [
            'shipment_id' => $shipment_id,
        ]);
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
}
