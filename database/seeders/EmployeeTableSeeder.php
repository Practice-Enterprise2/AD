<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        Employee::create([
            'user_id' => 1,
            'dateOfBirth' => '1990-01-01',
            'jobTitle' => 'Manager',
            'salary' => 50000,
            'Iban' => 'GB29NWBK60161331926819',
        ]);
        
        Employee::create([
            'user_id' => 2,
            'dateOfBirth' => '1995-05-05',
            'jobTitle' => 'Developer',
            'salary' => 40000,
            'Iban' => 'GB29NWBK60161331926820',
        ]);
        
        // add more employees as needed
    }
}