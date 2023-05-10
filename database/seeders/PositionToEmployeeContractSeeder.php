<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PositionToEmployeeContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('position_to_employee_contract')->insert([
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 4,
            'employee_contract_id' => 55,
        ],
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 3,
            'employee_contract_id' => 56,
        ],
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 1,
            'employee_contract_id' => 57,
        ],
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 1,
            'employee_contract_id' => 58,
        ],
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 4,
            'employee_contract_id' => 59,
        ],
        [
            'start_date' => Carbon::create(2022, 5, 15),
            'end_date' => Carbon::create(2025, 1, 1),
            'position_id' => 3,
            'employee_contract_id' => 60,
        ],
        ]);
    }
}
