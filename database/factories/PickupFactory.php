<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pickup>
 */
class PickupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shipment = Shipment::all()->random();
        $modify_date = rand(0, 1);
        $shipment_date = new Carbon($shipment->shipment_date);
        $status = rand(0, 2);

        switch ($status) {
            case 0:
                $status_value = 'pending';
                break;
            case 1:
                $status_value = 'completed';
                break;
            case 2:
                $status_value = 'canceled';
                break;
        }

        return [
            'shipment_id' => $shipment,
            'address_id' => Address::all()->random(),
            'time' => $shipment_date->modify("+$modify_date days"),
            'status' => $status_value,
        ];
    }
}
