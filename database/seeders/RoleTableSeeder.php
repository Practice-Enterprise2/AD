<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_regular_user = new Role;
        $role_regular_user->name = 'user';
        $role_regular_user->save();

        $role_regular_user = new Role;
        $role_regular_user->name = 'employee';
        $role_regular_user->save();

        $role_regular_user = new Role;
        $role_regular_user->name = 'admin';
        $role_regular_user->save();
    }
}
