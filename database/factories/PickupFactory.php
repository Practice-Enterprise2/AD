<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $pickup_address = $shipment->source_address;

        return [
            'shipment_id' => Shipment::all()->random(),
            'address_id' => $pickup_address->id,
            'time' => fake()->dateTimeBetween('now', '+3 days'),
            'status' => 'pending',
        ];
    }
}
