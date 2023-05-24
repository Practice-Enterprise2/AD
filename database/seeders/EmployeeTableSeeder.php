<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('employees')->insert([
            [
                'id' => 55,
                'user_id' => 55,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Driver',
                'salary' => 30000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 56,
                'user_id' => 56,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Developer',
                'salary' => 40000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 57,
                'user_id' => 57,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Project Manager',
                'salary' => 30000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 58,
                'user_id' => 58,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Project Manager',
                'salary' => 30000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 59,
                'user_id' => 59,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Driver',
                'salary' => 30000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 60,
                'user_id' => 60,
                'dateOfBirth' => '1990-01-01',
                'jobTitle' => 'Developer',
                'salary' => 30000,
                'Iban' => 'GB29NWBK60161331926819',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
