<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $addresses = Address::all()->random(2);
        return [
            'name' => fake()->word(),
            'source_address_id' => $addresses[0],
            'destination_address_id' => $addresses[1],
            'shipment_date' => fake()->dateTimeBetween('now', '+1 week'),
            'delivery_date' => fake()->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => 0,
            'expense' => fake()->numberBetween(1, 4),
            'weight' => fake()->numberBetween(1, 8),
            'type' => 'package',
            'user_id' => User::all()->random()->id,
        ];
    }
}
