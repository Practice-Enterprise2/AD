<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $verify_email = rand(1, 2);

        if ($verify_email == 1) {
            $email_verified_at = Carbon::now();
        } else {
            $email_verified_at = null;
        }

        return [
            'address_id' => Address::factory(),
            'name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'email_verified_at' => $email_verified_at,
            'password' => Hash::make(fake()->password),
            'phone' => fake()->phoneNumber,
        ];
    }
}
