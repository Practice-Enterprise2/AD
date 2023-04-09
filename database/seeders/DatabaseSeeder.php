<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Shipment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Address::factory()
        // ->count(50)
        // ->create();

        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
        ]);

        // Shipment::factory()
        // ->count(50)
        // ->create();
    }
}
