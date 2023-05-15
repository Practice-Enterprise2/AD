<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Shipment;
use App\Models\Waypoint;
use Illuminate\Contracts\View\View;

class WaypointController extends Controller
{
    public function create(Shipment $shipment): View
    {
        // dd($shipment);
        return view('shipments.set', compact('shipment'));
    }

    public function store(Shipment $shipment): View
    {
        /*$this->validate(request(), [
            'waypoints' => Waypoint::VALIDATION_RULES['array'],
            'waypoints.*.street' => Waypoint::VALIDATION_RULES['current_address.street'],
            'waypoints.*.house_number' => Waypoint::VALIDATION_RULES['current_address.house_number'],
            'waypoints.*.postal_code' => Waypoint::VALIDATION_RULES['current_address.postal_code'],
            'waypoints.*.city' => Waypoint::VALIDATION_RULES['current_address.city'],
            'waypoints.*.region' => Waypoint::VALIDATION_RULES['current_address.region'],
            'waypoints.*.country' => Waypoint::VALIDATION_RULES['current_address.country'],
        ],
            [
                'waypoints.*.street.regex' => 'Please enter a valid street for waypoint.',
                'waypoints.*.postal_code.regex' => 'Please enter a valid postal code for waypoint.',
                'waypoints.*.city.regex' => 'Please enter a valid city for waypoint.',
                'waypoints.*.region.regex' => 'Please enter a valid region for waypoint.',
                'waypoints.*.country.regex' => 'Please enter a valid country for waypoint.',
            ]
        );*/

        $waypoints = collect(request()->waypoints);

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

                // dd($current_address);

                if (! $current_address) {
                    dd("Something is wrong with the \$current_address refer:'shipments.requests.evaluate.set.store'.");
                }

                // $next_address = $waypoints[$i];
                $next_address = Address::query()->where([
                    'street' => $waypoints[$i]['street'],
                    'house_number' => $waypoints[$i]['house_number'],
                    'postal_code' => $waypoints[$i]['postal_code'],
                    'city' => $waypoints[$i]['city'],
                    'region' => $waypoints[$i]['region'],
                    'country' => $waypoints[$i]['country'],
                ])->first();

                // dd($next_address);
                if (! $next_address) {
                    $next_address = new Address();
                    $next_address->street = $waypoints[$i]['street'];
                    $next_address->house_number = $waypoints[$i]['house_number'];
                    $next_address->postal_code = $waypoints[$i]['postal_code'];
                    $next_address->city = $waypoints[$i]['city'];
                    $next_address->region = $waypoints[$i]['region'];
                    $next_address->country = $waypoints[$i]['country'];
                    $next_address->save();

                    // dd($next_address);
                }
                $status = 'Out For Delivery'; // presents this is the current waypoint.
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

                // $next_address = $waypoints[$i];

                $next_address = Address::query()->where([
                    'street' => $waypoints[$i]['street'],
                    'house_number' => $waypoints[$i]['house_number'],
                    'postal_code' => $waypoints[$i]['postal_code'],
                    'city' => $waypoints[$i]['city'],
                    'region' => $waypoints[$i]['region'],
                    'country' => $waypoints[$i]['country'],
                ])->first();

                // dd($next_address);
                if (! $next_address) {
                    $next_address = new Address();
                    $next_address->street = $waypoints[$i]['street'];
                    $next_address->house_number = $waypoints[$i]['house_number'];
                    $next_address->postal_code = $waypoints[$i]['postal_code'];
                    $next_address->city = $waypoints[$i]['city'];
                    $next_address->region = $waypoints[$i]['region'];
                    $next_address->country = $waypoints[$i]['country'];
                    $next_address->save();

                    // dd($next_address);
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

        // dd("flag");
        $waypoint = new Waypoint();
        $waypoint->shipment_id = $shipment->id;
        $waypoint->status = 'In Transit';
        // $waypoint->current_address = $waypoints[$waypoints->count() - 1];
        $waypoint->current_address_id = $current_address->id;
        // $waypoint->next_address = $shipment->destination_address;
        $waypoint->next_address_id = $next_address->id;
        $waypoint->push();

        $shipment->status = 'Awaiting Pickup';
        $shipment->update();
        dd('Check Waypoints Table');
    }

    public function update(Shipment $shipment): void
    {
        if ($shipment->status == 'Delivered') {
            dd('Shipments is already Delivered!');
        }
        $current_waypoint = $shipment->waypoints()->where('status', 'Out For Delivery')->first();

        // checking if it is the first waypoint
        if ($current_waypoint->current_address_id == $shipment->source_address_id) {
            // more validation needed later on. (EX: what if there are no transit addresses?)
            $shipment->status = 'In Transit';
            $shipment->update();
        }

        if ($current_waypoint->next_address_id == $shipment->destination_address_id) {
            $current_waypoint->status = 'Delivered';
            $current_waypoint->update();
            $shipment->status = 'Delivered';
            $shipment->update();
        } else {
            $next_waypoint = $shipment->waypoints()->where('current_address_id', $current_waypoint->next_address_id)->first();
            $current_waypoint->status = 'Delivered';
            $current_waypoint->update();
            $next_waypoint->status = 'Out For Delivery';
            $next_waypoint->update();

            // checking if it is the last waypoint
            if ($next_waypoint->next_address_id == $shipment->destination_address_id) {
                $shipment->status = 'Out For Delivery';
                $shipment->update();
            }
        }
        dd('Waypoints updated. Check Database.');
    }
}
