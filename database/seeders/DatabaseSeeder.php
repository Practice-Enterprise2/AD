<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Pickup;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory()
        ->count(50)
        ->create();

        $this->call([
            RoleTableSeeder::class,
        ]);

        $admin = new User;
        $admin->name = "Administrator";
        $admin->email = 'admin@local.test';
        $admin->password = Hash::make('letmein');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $employee = new User;
        $employee->name = "Employee";
        $employee->email = 'employee@local.test';
        $employee->password = Hash::make('letmein');
        $employee->save();
        $employee->roles()->attach(Role::where('name', 'employee')->first());

        $user = new User;
        $user->name = "User";
        $user->email = 'user@local.test';
        $user->password = Hash::make('letmein');
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());

        /* User::factory() */
        /* ->hasRoles(1, ['name' => 'user']) */
        /* ->count(50) */
        /* ->create(); */

        Shipment::factory()
        ->count(50)
        ->create();

        Pickup::factory()
        ->count(50)
        ->create();

    }
}
