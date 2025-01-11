<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizationIds = Organization::orderBy('id')->pluck('id')->toArray();
        $activityIds = Activity::pluck('id')->toArray();
        $organizationActivities = [];
        foreach ($organizationIds as $organizationId) {
            $activityCount = rand(1, 5);
            $activities = array_rand(array_flip($activityIds), $activityCount);
            if (!is_array($activities)) {
                $activities = [$activities];
            }
            $fullActivities = $activities;
            foreach ($activities as $activityId) {
                $activity = Activity::with('parent')->where('id', $activityId)->first();
                if ($activity->parent_id && !in_array($activity->parent_id, $fullActivities)) {
                    $fullActivities[] = $activity->parent_id;
                }
                if ($activity->parent && $activity->parent->parent_id && !in_array($activity->parent->parent_id, $fullActivities)) {
                    $fullActivities[] = $activity->parent->parent_id;
                }
                sort($fullActivities);
            }

            foreach ($fullActivities as $activityId) {
                $data = [
                    'organization_id' => $organizationId,
                    'activity_id' => $activityId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $organizationActivities[] = $data;
            }
        }

        DB::table('organization_activity')->insert($organizationActivities);
    }
}
