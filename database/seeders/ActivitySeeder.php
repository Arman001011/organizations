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

//    private function createActivities($parentId = null, $level = 1, $continue = 20)
//    {
//        $level ++;
//        $count = rand(2, 7);
//
//        for ($i = 0; $i < $count; $i++) {
//            $activity = Activity::factory()->create([
//                'parent_id' => $parentId,
//            ]);
//
//            if (rand(0, 100) < $continue || $level <= 3) {
//                $this->createActivities($activity->id, $level, $continue);
//            }
//        }
//    }
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

