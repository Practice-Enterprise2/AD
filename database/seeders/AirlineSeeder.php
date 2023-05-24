<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('airlines')->insert([
            [
                'name' => 'American Airlines',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delta Air Lines',
                'price' => 220,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Southwest Airlines',
                'price' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'United Airlines',
                'price' => 210,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Canada',
                'price' => 230,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'British Airways',
                'price' => 240,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lufthansa',
                'price' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air France',
                'price' => 260,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Qantas',
                'price' => 270,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emirates',
                'price' => 280,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
