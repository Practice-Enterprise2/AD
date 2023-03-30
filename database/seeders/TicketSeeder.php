<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('tickets')->insert([
                'ticketID' => $faker->unique()->randomNumber(8),
                'cstID' => $faker->unique()->randomNumber(5),
                'employeeID' => $faker->unique()->randomNumber(5),
                'issue' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'solution' => $faker->paragraph(),
                'status' => $faker->randomElement(['solved', 'unsolved']),
        ]);
    }
}}
