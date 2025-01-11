<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $count = rand(1, 5);
        $phones = [];
        for ($i = 0; $i < $count; $i++) {
            $phones[] = fake()->phoneNumber();
        }
        $buildingIds = Building::pluck('id')->toArray();
        $buildingId = $buildingIds[array_rand($buildingIds)];

        return [
            'name' => fake()->company(),
            'phone_numbers' => json_encode($phones),
            'building_id' => $buildingId,
            'status' => fake()->boolean(90) ? Activity::STATUS_ACTIVE : Activity::STATUS_INACTIVE,
        ];
    }
}
