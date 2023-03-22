<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'street' => fake()->streetName,
            'house_number' => fake()->numberBetween(1, 5000),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'region' => fake()->state(),
            'country' => fake()->country(),
        ];
    }
}
