<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Airport;
use App\Models\Depot;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Waypoint;
use App\Notifications\ShipmentUpdated;
use Illuminate\Contracts\View\View;

class WaypointController extends Controller
{
    public function confirmWaypoint(string $shipment)
    {
        $shipmentData = Shipment::where('id', $shipment)->first();

        return view('shipments.confirm-waypoint', [
            'shipment' => $shipmentData,
        ]);
    }

    public function exceptionWaypoint(string $shipment)
    {
        $shipmentData = Shipment::where('id', $shipment)->first();
        $shipmentData->status = 'Exception';
        $shipmentData->update();
        dd('This shipment status has become Exception!!!!');
    }

    public function create(Shipment $shipment): View
    {
        $country_codes = collect([]);
        $countries = [
            $shipment->source_address->country,
            $shipment->destination_address->country,
        ];

        // query that retrieves the depots that has the same country as the source and destination addresses for the shipment object.
        $depots = Depot::whereHas('address', function ($query) use ($countries) {
            $query->whereIn('country', $countries);
        })->get();

        $airports = Airport::whereHas('address', function ($query) use ($countries) {
            $query->whereIn('country', $countries);
        })->get();

        return view('shipments.set', compact(['shipment', 'depots', 'airports']));
    }

    public function store(Shipment $shipment)
    {
        $shipment_exist = Waypoint::where('shipment_id', $shipment->id)->first();
        if ($shipment_exist) {
            return redirect()->route('shipments.requests')->with('alert', "Waypoints for shipment with id: {$shipment->id} already assigned!");
        }

        $waypoint_ids = collect(request()->waypoints);

        $waypoints = collect([]);
        for ($i = 0; $i < $waypoint_ids->count(); $i++) {
            if (isset($waypoint_ids[$i]['depot_id'])) {
                $address = Depot::find($waypoint_ids[$i]['depot_id'])->address;
                $waypoint = [];
                $waypoint['id'] = $waypoint_ids[$i]['depot_id'];
                $waypoint['type'] = 'depot'; //branch need a change to depot
            } elseif (isset($waypoint_ids[$i]['airport_id'])) {
                $address = Airport::find($waypoint_ids[$i]['airport_id'])->address;
                $waypoint = [];
                $waypoint['id'] = $waypoint_ids[$i]['airport_id'];
                $waypoint['type'] = 'airport';
            }
            $waypoint['street'] = $address->street;
            $waypoint['house_number'] = $address->house_number;
            $waypoint['postal_code'] = $address->postal_code;
            $waypoint['city'] = $address->city;
            $waypoint['region'] = $address->region;
            $waypoint['country'] = $address->country;
            $waypoints->push($waypoint);
        }

        for ($i = 0; $i < $waypoints->count(); $i++) {
            if ($i == 0) {
                // $current_address = $shipment->source_address;
                $current_address = Address::query()->where([
                    'street' => $shipment->source_address->street,
                    'house_number' => $shipment->source_address->house_number,
                    'postal_code' => $shipment->source_address->postal_code,
                    'city' => $shipment->source_address->city,
                    'region' => $shipment->source_address->region,
                    'country' => $shipment->source_address->country,
                ])->first();

                if (! $current_address) {
                    $current_address = new Address();
                    $current_address->street = $shipment->source_address->street;
                    $current_address->house_number = $shipment->source_address->house_number;
                    $current_address->postal_code = $shipment->source_address->postal_code;
                    $current_address->city = $$shipment->source_address->city;
                    $current_address->region = $shipment->source_address->region;
                    $current_address->country = $shipment->source_address->country;
                    $current_address->save();
                }

                if (! $current_address) {
                    dd("Something is wrong with the \$current_address refer:'shipments.requests.evaluate.set.store'.");
                }

                $next_address = Address::query()->where([
                    'street' => $waypoints[$i]['street'],
                    'house_number' => $waypoints[$i]['house_number'],
                    'postal_code' => $waypoints[$i]['postal_code'],
                    'city' => $waypoints[$i]['city'],
                    'region' => $waypoints[$i]['region'],
                    'country' => $waypoints[$i]['country'],
                ])->first();

                if (! $next_address) {
                    $next_address = new Address();
                    $next_address->street = $waypoints[$i]['street'];
                    $next_address->house_number = $waypoints[$i]['house_number'];
                    $next_address->postal_code = $waypoints[$i]['postal_code'];
                    $next_address->city = $waypoints[$i]['city'];
                    $next_address->region = $waypoints[$i]['region'];
                    $next_address->country = $waypoints[$i]['country'];
                    $next_address->save();
                }
                $status = 'Awaiting Action';  // presents this is the current waypoint.
            } else {
                // $current_address = $waypoints[$i - 1];
                $current_address = Address::query()->where([
                    'street' => $waypoints[$i - 1]['street'],
                    'house_number' => $waypoints[$i - 1]['house_number'],
                    'postal_code' => $waypoints[$i - 1]['postal_code'],
                    'city' => $waypoints[$i - 1]['city'],
                    'region' => $waypoints[$i - 1]['region'],
                    'country' => $waypoints[$i - 1]['country'],
                ])->first();

                if (! $current_address) {
                    $current_address = new Address();
                    $current_address->street = $waypoints[$i - 1]['street'];
                    $current_address->house_number = $waypoints[$i - 1]['house_number'];
                    $current_address->postal_code = $waypoints[$i - 1]['postal_code'];
                    $current_address->city = $waypoints[$i - 1]['city'];
                    $current_address->region = $waypoints[$i - 1]['region'];
                    $current_address->country = $waypoints[$i - 1]['country'];
                    $current_address->save();
                }

                $next_address = Address::query()->where([
                    'street' => $waypoints[$i]['street'],
                    'house_number' => $waypoints[$i]['house_number'],
                    'postal_code' => $waypoints[$i]['postal_code'],
                    'city' => $waypoints[$i]['city'],
                    'region' => $waypoints[$i]['region'],
                    'country' => $waypoints[$i]['country'],
                ])->first();

                if (! $next_address) {
                    $next_address = new Address();
                    $next_address->street = $waypoints[$i]['street'];
                    $next_address->house_number = $waypoints[$i]['house_number'];
                    $next_address->postal_code = $waypoints[$i]['postal_code'];
                    $next_address->city = $waypoints[$i]['city'];
                    $next_address->region = $waypoints[$i]['region'];
                    $next_address->country = $waypoints[$i]['country'];
                    $next_address->save();
                }

                $status = 'In Transit';
            }

            $waypoint = new Waypoint();
            $waypoint->shipment_id = $shipment->id;
            $waypoint->status = $status;
            $waypoint->current_address_id = $current_address->id;
            $waypoint->next_address_id = $next_address->id;
            $waypoint->push();
        }

        // Last Waypoint
        $current_address = Address::query()->where([
            'street' => $waypoints[$waypoints->count() - 1]['street'],
            'house_number' => $waypoints[$waypoints->count() - 1]['house_number'],
            'postal_code' => $waypoints[$waypoints->count() - 1]['postal_code'],
            'city' => $waypoints[$waypoints->count() - 1]['city'],
            'region' => $waypoints[$waypoints->count() - 1]['region'],
            'country' => $waypoints[$waypoints->count() - 1]['country'],
        ])->first();

        if (! $current_address) {
            $current_address = new Address();
            $current_address->street = $waypoints[$waypoints->count() - 1]['street'];
            $current_address->house_number = $waypoints[$waypoints->count() - 1]['house_number'];
            $current_address->postal_code = $waypoints[$waypoints->count() - 1]['postal_code'];
            $current_address->city = $waypoints[$waypoints->count() - 1]['city'];
            $current_address->region = $waypoints[$waypoints->count() - 1]['region'];
            $current_address->country = $waypoints[$waypoints->count() - 1]['country'];
            $current_address->save();
        }

        $next_address = Address::query()->where([
            'street' => $shipment->destination_address->street,
            'house_number' => $shipment->destination_address->house_number,
            'postal_code' => $shipment->destination_address->postal_code,
            'city' => $shipment->destination_address->city,
            'region' => $shipment->destination_address->region,
            'country' => $shipment->destination_address->country,
        ])->first();

        if (! $next_address) {
            $next_address = new Address();
            $next_address->street = $shipment->destination_address->street;
            $next_address->house_number = $shipment->destination_address->house_number;
            $next_address->postal_code = $shipment->destination_address->postal_code;
            $next_address->city = $$shipment->destination_address->city;
            $next_address->region = $shipment->destination_address->region;
            $next_address->country = $shipment->destination_address->country;
            $next_address->save();
        }

        $waypoint = new Waypoint();
        $waypoint->shipment_id = $shipment->id;
        $waypoint->status = 'In Transit';
        $waypoint->current_address_id = $current_address->id;
        $waypoint->next_address_id = $next_address->id;
        $waypoint->push();

        $shipment->status = 'Awaiting Pickup';
        $shipment->update();

        $shipmentChanges = $shipment->getChanges();
        $source_user = User::query()->where('id', $shipment->user_id)->first();
        $source_user->notify(new ShipmentUpdated($shipment, $shipmentChanges));

        return redirect()->route('shipments.requests')->with('alert', "Waypoints for shipment with id: {$shipment->id} set!");
    }

    public function update(Shipment $shipment): void
    {
        if ($shipment->status == 'Delivered') {
            dd('Shipments is already Delivered!');
        }
        if ($shipment->status == 'Exception') {
            dd('This Shipments has Exception status!!!!!');
        }
        $current_waypoint = $shipment->waypoints()->where('status', 'Out For Delivery')->first();

        if (is_null($current_waypoint)) {
            $current_waypoint = $shipment->waypoints()->where('status', 'Awaiting Action')->first();
        }

        if (is_null($current_waypoint)) {
            $current_waypoint = $shipment->waypoints()->where('status', 'Received')->first();
        }

        if (is_null($current_waypoint)) {
            $current_waypoint = $shipment->waypoints()->where('status', 'Out For Client')->first();
        }

        // checking if it is the first waypoint
        if ($current_waypoint->current_address_id == $shipment->source_address_id) {
            // more validation needed later on. (EX: what if there are no transit addresses?)
            $shipment->status = 'In Transit';
            $shipment->update();
        }

        if ($current_waypoint->next_address_id == $shipment->destination_address_id) {
            if ($current_waypoint->status == 'Out For Delivery') {
                $current_waypoint->status = 'Received';
                $current_waypoint->update();
            } elseif ($current_waypoint->status == 'Received') {
                $current_waypoint->status = 'Out For Client';
                $current_waypoint->update();

                // Since it is not IN TRANSIT anymore
                $shipment->status = 'Out For Delivery';
                $shipment->update();
            } elseif ($current_waypoint->status == 'Out For Client') {
                $current_waypoint->status = 'Delivered';
                $current_waypoint->update();
                $shipment->status = 'Delivered';
                $shipment->update();
            }
        } else {
            if ($current_waypoint->status == 'Out For Delivery') {
                $current_waypoint->status = 'Received';
                $current_waypoint->update();
                dd('waypoint with id: '.$current_waypoint->id." state changed to: 'received'");
            }

            if ($current_waypoint->status == 'Received' || $current_waypoint->status == 'Awaiting Action') {
                $next_waypoint = $shipment->waypoints()->where('current_address_id', $current_waypoint->next_address_id)->first();
                $current_waypoint->status = 'Delivered';
                $current_waypoint->update();
                $next_waypoint->status = 'Out For Delivery';
                $next_waypoint->update();
            }
        }

        $shipmentChanges = $shipment->getChanges();
        $source_user = User::query()->where('id', $shipment->user_id)->first();
        $source_user->notify(new ShipmentUpdated($shipment, $shipmentChanges));
        dd('waypoint with id: '.$current_waypoint->id.' state changed');
    }
}
