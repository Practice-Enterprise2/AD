<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
            'name' => 'staf',
            'email' => 'customer@example.com',
            'address' => 'street',
            'city' => 'city',
            'postalcode' => 'postalcode',
            'country' => 'counrty',
            'password' =>  Hash::make('test123456'),
            'phone' => "0488574564",
            'role' => '0'
         ]);
         \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'address' => 'street',
            'city' => 'city',
            'postalcode' => 'postalcode',
            'country' => 'counrty',
            'password' =>  Hash::make('test123456'),
            'phone' => "0488574564",
            'role' => '1'
         ]);
    }
}
