<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {
            $this->run(ActivitySeeder::class);
            $this->run(BuildingSeeder::class);
            $this->run(OrganizationSeeder::class);
            $this->run(OrganizationActivitySeeder::class);
            $this->run(ApiStaticKeySeeder::class);
        }
    }
}
