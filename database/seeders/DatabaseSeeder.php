<?php

namespace Database\Seeders;

use App\Providers\AppServiceProvider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // This always needs to run when the database is regenerated, even in
        // production (which is done automatically)!
        AppServiceProvider::bootstrap_database();

        $this->call([
            DepotSeeder::class,
            AiGraphSeeder::class,
            AirportSeeder::class,
            AirportContractSeeder::class,
            VacantJobsSeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            DimensionSeeder::class,
            ShipmentSeeder::class,
        ]);
    }
}
