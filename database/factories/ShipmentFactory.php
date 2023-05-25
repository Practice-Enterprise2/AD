<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random_date_offset = rand(1, 14);
        $shipment_date = fake()->dateTimeBetween('-2 years', 'now');

        return [
            'source_address_id' => Address::factory(),
            'destination_address_id' => Address::factory(),
            'shipment_date' => Carbon::instance($shipment_date),
            'delivery_date' => Carbon::instance($shipment_date->modify("+$random_date_offset days")),
            'expense' => rand(2, 100),
            'weight' => rand(1, 6),
            'type' => 'fragile',
            'user_id' => 1,
            'receiver_name' => fake()->name,
            'receiver_email' => fake()->email,
            'dimension_id' => 1,
            'status' => 'Awaiting Confirmation',
        ];
    }
}
