<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetName,
            'house_number' => fake()->numberBetween(1, 10000),
            'postal_code' => fake()->postcode,
            'city' => fake()->city,
            'region' => fake()->name,
            'country' => fake()->country,
        ];
    }
}
