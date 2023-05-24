<?php

namespace Database\Seeders;

use App\Models\Pickup;
use Illuminate\Database\Seeder;

class PickupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pickup::factory()
            ->count(40)
            ->create();
    }
}
