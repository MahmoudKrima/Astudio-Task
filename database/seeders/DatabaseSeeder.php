<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\AttributeSeeder;
use Database\Seeders\TimeSheetSeeder;
use Database\Seeders\AttributeValueSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            TimeSheetSeeder::class,
        ]);
    }
}
