<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Shipment;
use App\Providers\AppServiceProvider;
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

        /* Shipment::factory() */
        /* ->count(50) */
        /* ->create(); */

        // This always needs to run when the database is regenerated, even in
        // production (which is done automatically)!
        AppServiceProvider::bootstrap_database();
    }
}
