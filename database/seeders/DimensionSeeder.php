<?php

namespace Database\Seeders;

use App\Models\Dimension;
use Illuminate\Database\Seeder;

class DimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dimension::factory()
            ->count(40)
            ->create();
    }
}
