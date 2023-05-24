<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = DB::table('employees')->orderBy('created_at', 'desc')->take(7)->get();
        $timestamp = date('Y-m-d');

        $end_date = '2026-01-01';
        function randomDate($timestamp, $end_date)
        {
            $min = strtotime($timestamp);
            $max = strtotime($end_date);
            $val = rand($min, $max);

            return date('Y-m-d', $val);
        }
        for ($i = 0; $i < count($employees); $i++) {
            DB::table('employee_contracts')->insert([
                'employee_id' => $employees[$i]->id,
                'start_date' => $timestamp,
                'end_date' => randomDate($timestamp, $end_date),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $this->call([
            HolidaySaldoSeeder::class,
        ]);
    }
}
