<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShiftsTableSeeder extends Seeder
{
    public function run()
{
    DB::table('shifts')->insert([
        [
            'employee_id' => 1,
            'planned_start_time' => '2023-04-19 09:00:00',
            'planned_end_time' => '2023-04-19 17:00:00',
            'actual_start_time' => null,
            'actual_end_time' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'employee_id' => 1,
            'planned_start_time' => '2023-04-20 12:00:00',
            'planned_end_time' => '2023-04-20 20:00:00',
            'actual_start_time' => '2023-04-20 12:00:00',
            'actual_end_time' => '2023-04-20 20:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'employee_id' => 1,
            'planned_start_time' => '2023-04-21 08:00:00',
            'planned_end_time' => '2023-04-21 16:00:00',
            'actual_start_time' => '2023-04-21 08:30:00',
            'actual_end_time' => '2023-04-21 16:15:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    }
}