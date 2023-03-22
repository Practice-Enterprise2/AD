<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Pickup;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory()
        ->count(50)
        ->create();

        if (!User::where('email', 'user@local.test')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user@local.test',
                'password' => bcrypt('letmein'),
                'email_verified_at' => null,
                'remember_token' => Str::random(10),
            ]);
        }

        if (!User::where('email', 'admin@local.test')->exists()) {
            User::create([
                'name' => 'Test Admin',
                'email' => 'admin@local.test',
                'password' => bcrypt('letmein'),
                'email_verified_at' => null,
                'remember_token' => Str::random(10),
            ]);
        }

        if (!User::where('email', 'employee@local.test')->exists()) {
            User::create([
                'name' => 'Test Employee',
                'email' => 'employee@local.test',
                'password' => bcrypt('letmein'),
                'email_verified_at' => null,
                'remember_token' => Str::random(10),
            ]);
        }

        User::factory()
        ->count(50)
        ->create();

        Shipment::factory()
        ->count(50)
        ->create();

        Pickup::factory()
        ->count(50)
        ->create();
        // Use factories from models (\App\Models) to fill database.

        $this->call([
            RoleTableSeeder::class,
        ]);
    }
}
