<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Shipment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShipmentController extends Controller
{
    public function index(): View|Factory
    {
        $shipments = Shipment::query()->whereNot('status', 'Awaiting Confirmation')
                            ->whereNot('status', 'Declined')
                            ->with('waypoints')
                            ->get();

        return view('shipments.index', compact('shipments'));
    }

    //create
    public function create(): View|Factory
    {
        return view('shipments.create');
    }

    //store
    public function store(): string
    {

        $source_address = Address::query()->where([
            'street' => request()->source_street,
            'house_number' => request()->source_housenumber,
            'postal_code' => request()->source_postalcode,
            'city' => request()->source_city,
            'region' => request()->source_region,
            'country' => request()->source_country,
        ])->first();

        if (! $source_address) {
            $source_address = new Address();
            $source_address->country = request()->source_country;
            $source_address->region = request()->source_region;
            $source_address->postal_code = request()->source_postalcode;
            $source_address->city = request()->source_city;
            $source_address->street = request()->source_street;
            $source_address->house_number = request()->source_housenumber;
            $source_address->push();
        }

        $destination_address = Address::query()->where([
            'street' => request()->destination_street,
            'house_number' => request()->destination_housenumber,
            'postal_code' => request()->destination_postalcode,
            'city' => request()->destination_city,
            'region' => request()->destination_region,
            'country' => request()->destination_country,
        ])->first();

        if (! $destination_address) {
            $destination_address = new Address();
            $destination_address->country = request()->destination_country;
            $destination_address->region = request()->destination_region;
            $destination_address->postal_code = request()->destination_postalcode;
            $destination_address->city = request()->destination_city;
            $destination_address->street = request()->destination_street;
            $destination_address->house_number = request()->destination_housenumber;
            $destination_address->push();
        }

        $shipment = new Shipment();
        $shipment->user_id = request()->sender_id;
        $shipment->receiver_name = request()->receiver_name;
        $shipment->receiver_email = request()->receiver_email;
        $shipment->source_address_id = $source_address->id;
        $shipment->destination_address_id = $destination_address->id;
        $shipment->type = request()->handling_type[0];

        // (!) ATTENTION OF SHIPMENT GROUP. Attributes below need to be added to the form later on.
        $shipment->status = 'Awaiting Confirmation';
        $shipment->shipment_date = date('Y-m-d');
        $shipment->delivery_date = date('Y-m-d');
        $shipment->expense = 0;
        $shipment->weight = 0;

        $shipment->push();

        dd($shipment->getAttributes(), $source_address->getAttributes(), $destination_address->getAttributes());

        // notify user with the shipment_id as Tracking Number
        return 'Tracking Number: '.$shipment->id;
    }

    public function requests(): View|Factory
    {
        // dd("Catch");
        $shipments = Shipment::query()->where('status', 'Awaiting Confirmation')->get();
        // dd("Catch");
        // dd($shipments);
        return view('/shipments.requests', compact('shipments'));
    }

    public function evaluate(Shipment $shipment): RedirectResponse
    {
        if (request()->has('decline')) {
            $shipment->status = 'Declined';
            $shipment->update();

            return back();
        } elseif (request()->has('set')) {
            return redirect()->route('shipments.requests.evaluate.set', ['shipment' => $shipment]);
        } else {
            dd('Something gone wrong, refer Route with URI => [shipments/requests/evaluate/{shipment}]');
        }
    }
}