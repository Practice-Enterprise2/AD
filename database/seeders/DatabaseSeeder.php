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

        // it generates addresses and assign them into depots.
        $this->call(DepotSeeder::class);
        $this->call(AiGraphSeeder::class);
        $this->call(AirportTableSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(AirportContractSeeder::class);
        $this->call(VacantJobsSeeder::class);
    }
}
