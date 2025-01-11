<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $this->createActivities(null);
    }

    private function createActivities($parentId = null, $level = 1)
    {
        $level ++;
        $count = rand(4, 7);

        for ($i = 0; $i < $count; $i++) {
            $activity = Activity::factory()->create([
                'parent_id' => $parentId,
            ]);

            if (rand(0, 100) < 50 && $level <= 3) {
                $this->createActivities($activity->id, $level);
            }
        }
    }
}

