<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User;
        $admin->name = "Administrator";
        $admin->username = 'admin';
        $admin->email = 'admin@local.test';
        $admin->password = Hash::make('letmein');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $employee = new User;
        $employee->name = "Employee";
        $employee->username = 'employee';
        $employee->email = 'employee@local.test';
        $employee->password = Hash::make('letmein');
        $employee->save();
        $employee->roles()->attach(Role::where('name', 'employee')->first());

        $user = new User;
        $user->name = "User";
        $user->username = 'user';
        $user->email = 'user@local.test';
        $user->password = Hash::make('letmein');
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());
    }
}
