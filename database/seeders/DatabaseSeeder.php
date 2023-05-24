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
            UserSeeder::class,
            PositionTableSeeder::class,
            EmployeeTableSeeder::class,
            EmployeeContractsSeeder::class,
            PositionToEmployeeContractSeeder::class,
        ]);

        // it generates addresses and assign them into depots.
        $this->call(DepotSeeder::class);
        $this->call(AiGraphSeeder::class);
    }
}
