<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@local.test';
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->password = Hash::make('letmein');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $employee = new User();
        $employee->name = 'Employee';
        $employee->email = 'employee@local.test';
        $employee->email_verified_at = date('Y-m-d H:i:s');
        $employee->password = Hash::make('letmein');
        $employee->save();
        $employee->roles()->attach(Role::where('name', 'employee')->first());

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@local.test';
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password = Hash::make('letmein');
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());
    }
}
