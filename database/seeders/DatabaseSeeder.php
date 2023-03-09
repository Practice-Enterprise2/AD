<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Use factories from models (\App\Models) to fill database.

        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
