<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->unique()->word()),
            'parent_id' => null,
            'status' => fake()->boolean(90) ? Activity::STATUS_ACTIVE : Activity::STATUS_INACTIVE,
        ];
    }
}
