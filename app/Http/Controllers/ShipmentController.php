<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Dimensions;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Waypoint;
use App\Notifications\ShipmentUpdated;
use DateTime;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        // $shippingDateStart = new DateTime();
        // $shippingDateEnd = (new DateTime())->modify('+6 days');
        // $shippingDates = [];
        // for($i = $shippingDateStart; $i <= $shippingDateEnd; $i->modify('+1 day')){
        //     $shippingDates[] = $i->format('Y-m-d');
        // }
        // Generate list of dates for the next 7 days
        $deliveryDateStart = (new DateTime())->modify('+2 days');
        $deliveryDateEnd = (new DateTime())->modify('+8 days');
        $deliveryDates = [];
        for ($i = $deliveryDateStart; $i <= $deliveryDateEnd; $i->modify('+1 day')) {
            $deliveryDates[] = $i->format('Y-m-d');
        }

        return view('shipments.create', compact('deliveryDates'));
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

        // Convert string to time and send selected dates to db
        $shipment->shipment_date = date('Y-m-d', strtotime(request()->input('delivery_date')));
        $shipment->delivery_date = date('Y-m-d', strtotime(request()->input('shipment_date')));

        //Dimensions
        $dimensions = new Dimensions();
        $dimensions->length = request()->shipment_length;
        $dimensions->width = request()->shipment_width;
        $dimensions->height = request()->shipment_height;
        $dimensions->save();
        $shipment->weight = request()->shipment_weight;
        $shipment->dimension_id = $dimensions->id;

        // Calculate shipping cost
        $volumetric_freight = 0;
        $volumetric_freight_tarrif = 5;
        $dense_cargo_tarrif = 4;
        $expense_excl_VAT = 0;
        $VAT_percentage = 0;
        $volumetric_freight += (($dimensions->length * $dimensions->width * $dimensions->height) / 5000);
        if ($volumetric_freight > $shipment->weight) {
            //Volumetric Air Freight rate
            $shipment->expense = $volumetric_freight * $volumetric_freight_tarrif;
        } else {
            //Dense Cargo rate
            $shipment->expense = $shipment->weight * $dense_cargo_tarrif;
        }

        $shipment->status = 'Awaiting Confirmation';

        // Shipment creation info - Joppe
        $shipment->created_at = date('Y-m-d H:i:s');
        $shipment->updated_at = date('Y-m-d H:i:s');
        $shipment->deleted_at = date('Y-m-d H:i:s');

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

    public function edit(Shipment $shipment)
    {
        return view('shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $source_address = Address::query()->where([
            'id' => $shipment->source_address_id,
        ])->first();

        $source_address->update([
            'country' => request()->source_country,
            'region' => request()->source_region,
            'postal_code' => request()->source_postalcode,
            'city' => request()->source_city,
            'street' => request()->source_street,
            'house_number' => request()->source_housenumber,
        ]);

        $destination_address = Address::query()->where([
            'id' => $shipment->destination_address_id,
        ])->first();

        $destination_address->update([
            'country' => request()->destination_country,
            'region' => request()->destination_region,
            'postal_code' => request()->destination_postalcode,
            'city' => request()->destination_city,
            'street' => request()->destination_street,
            'house_number' => request()->destination_housenumber,
        ]);

        $shipment->update([
            'receiver_name' => request()->receiver_name,
            'receiver_email' => request()->receiver_email,
            'status' => request()->status,
            'type' => request()->handling_type[0],
        ]);

        if ($shipment->wasChanged()) {
            $shipmentChanges = $shipment->getChanges();
            $source_user = User::query()->where('id', $shipment->user_id)->first();
            $source_user->notify(new ShipmentUpdated($shipment, $shipmentChanges));
        }

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Shipment $shipment)
    {
        // We can't delete the shipment completely, because we are using SoftDeletes.
        // Because of this we will have shipment data in the database, but we will not be able to see it.
        // Also we will not be able to delete the addresses, because they are used in the shipment.
        // If we remove the SoftDeletes from the Shipment model, we will be able to delete the shipment and the addresses.
        // If you uncomment the lines below, you will be able to delete the shipment and the addresses after removing the SoftDeletes from the Shipment model.

        // $source_address = Address::query()->where([
        //     'id' => $shipment->source_address_id,
        // ])->first();

        // $destination_address = Address::query()->where([
        //     'id' => $shipment->destination_address_id,
        // ])->first();

        // foreach ($waypoints as $waypoint) {
        //     $waypoint_address[] = Address::query()->where([
        //         'id' => $waypoint->current_address_id,
        //     ])->first();
        // }

        $waypoints = Waypoint::query()->where([
            'shipment_id' => $shipment->id,
        ])->get();

        foreach ($waypoints as $waypoint) {
            $waypoint->delete();
        }

        $shipment->delete();

        // $source_address->delete();
        // $destination_address->delete();

        // foreach ($waypoint_address as $address) {
        //     $address->delete();
        // }

        return redirect()->route('shipments.index')
            ->with('success', 'Shipment deleted successfully');
    }

    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }
}
