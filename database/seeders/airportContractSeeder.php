<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contracts')->insert([
            [
                'airline_id' => 1,
                'depart_airport_id' => 2,
                'destination_airport_id' => 3,
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'price' => 1500,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'airline_id' => 2,
                'depart_airport_id' => 2,
                'destination_airport_id' => 1,
                'start_date' => '2023-02-01',
                'end_date' => '2023-12-31',
                'price' => 1800,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'airline_id' => 3,
                'depart_airport_id' => 1,
                'destination_airport_id' => 2,
                'start_date' => '2023-03-01',
                'end_date' => '2023-12-31',
                'price' => 2000,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'airline_id' => 4,
                'depart_airport_id' => 3,
                'destination_airport_id' => 1,
                'start_date' => '2023-04-01',
                'end_date' => '2023-12-31',
                'price' => 2200,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'airline_id' => 5,
                'depart_airport_id' => 1,
                'destination_airport_id' => 3,
                'start_date' => '2023-05-01',
                'end_date' => '2023-12-31',
                'price' => 2400,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
