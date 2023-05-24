<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 55,
                'address_id' => null,
                'name' => 'testDriver',
                'last_name' => 'testFam',
                'email' => 'testDriver@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
            [
                'id' => 56,
                'address_id' => null,
                'name' => 'testDev',
                'last_name' => 'testFam',
                'email' => 'testDev@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
            [
                'id' => 57,
                'address_id' => null,
                'name' => 'testPM',
                'last_name' => 'testFam',
                'email' => 'testPM@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
            [
                'id' => 58,
                'address_id' => null,
                'name' => 'testPM2',
                'last_name' => 'testFam',
                'email' => 'testPM2@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
            [
                'id' => 59,
                'address_id' => null,
                'name' => 'testDriver2',
                'last_name' => 'testFam',
                'email' => 'testDriver2@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
            [
                'id' => 60,
                'address_id' => null,
                'name' => 'testDev2',
                'last_name' => 'testFam',
                'email' => 'testDev2@local.test',
                'email_verified_at' => now(),
                'password' => Hash::make('letmein'),
                'phone' => null,
                'role' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
                'is_locked' => 0,
            ],
        ]);
    }
}
