<?php

namespace Database\Seeders;

use App\Models\ApiStaticKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiStaticKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'static-key-1'],
            ['key' => 'static-key-2'],
        ];
        foreach ($data as $item) {
            $exists = ApiStaticKey::where('key', $item['key'])->exists();
            if (!$exists) {
                ApiStaticKey::create($item);
            }
        }
    }
}
