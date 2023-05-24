<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('airports')->insert([
            [
                'iata_code' => 'LAX',
                'name' => 'Los Angeles International Airport',
                'land' => 'United States',
                'address_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'iata_code' => 'JFK',
                'name' => 'John F. Kennedy International Airport',
                'land' => 'United States',
                'address_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'iata_code' => 'LHR',
                'name' => 'London Heathrow Airport',
                'land' => 'United Kingdom',
                'address_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'iata_code' => 'CDG',
                'name' => 'Charles de Gaulle Airport',
                'land' => 'France',
                'address_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'iata_code' => 'HND',
                'name' => 'Tokyo Haneda Airport',
                'land' => 'Japan',
                'address_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
