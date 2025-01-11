<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiStaticKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('api_static_keys')->insert([
            ['key' => 'static-key-1'],
            ['key' => 'static-key-2'],
        ]);
    }
}
