<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_contracts')->insert([
            [
                'id' => 55,
                'employee_id' => 55,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 56,
                'employee_id' => 56,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 57,
                'employee_id' => 57,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 58,
                'employee_id' => 58,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 59,
                'employee_id' => 59,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 60,
                'employee_id' => 60,
                'start_date' => Carbon::create(2022, 5, 15),
                'end_date' => Carbon::create(2025, 1, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
