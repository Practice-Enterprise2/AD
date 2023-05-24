<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
        ]);
        $userList = DB::table('users')->get();
        $userCount = count($userList);
        $start_date = "1960-01-01";
        $end_date = "1960-01-01";
        $jobList = ["Accountant", "Manager", 'Developer', 'Lead Developer', 'Assistant Manager', 'Software Engineer', 'Data Analyst'];
        
        for($i = 0; $i > ($userCount/2); $i++)
        {
            DB::table('employees')->insert([
                'user_id' => $userCount-1,
                'dateOfBirth' => EmployeeSeeder::randomDate($start_date, $end_date),
                'jobTitle' => $jobList [random_int(0, 6)],
                'salary' => random_int(1500, 5000),
                //too hard to generate valid IBANs
                'Iban' => 'NL32RABO2318696306',
                'created_at' => now(),
                'updated_at' => now()

            ]);
        }
    }
    function randomDate($start_date, $end_date)
    {
    
    $min = strtotime($start_date);
    $max = strtotime($end_date);
    $val = rand($min, $max);
    return date('Y-m-d H:i:s', $val);
    }
}
