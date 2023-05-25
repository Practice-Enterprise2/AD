<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();
        $this->call([
            UserSeeder::class,
        ]);
        $users = DB::table('users')->where('created_at', '>=', $timestamp)->get();
        $start_date = '1960-01-01';
        $end_date = '2005-01-01';
        $jobList = ['Accountant', 'Manager', 'Developer', 'Lead Developer', 'Assistant Manager', 'Software Engineer', 'Data Analyst'];
        $Ibans = ['NL32RABO2318696306', 'NL58INGB7723597010', 'NL79RABO7114507283', 'NL06RABO8902022560', 'NL28ABNA8193596846'];

        function randomDate($start_date, $end_date)
        {
            $min = strtotime($start_date);
            $max = strtotime($end_date);
            $val = rand($min, $max);

            return date('Y-m-d', $val);
        }

        for ($i = 0; $i < count($users); $i++) {
            DB::table('employees')->insert([
                'user_id' => $users[$i]->id,
                'dateOfBirth' => randomDate($start_date, $end_date),
                'jobTitle' => $jobList[random_int(0, 6)],
                'salary' => random_int(1500, 5000),
                //too hard to generate valid IBANs
                'Iban' => $Ibans[random_int(0, 4)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
