<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Organization extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;


    protected $fillable = [
        'name',
        'phone_numbers',
        'building_id',
        'status',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'organization_activity')->withTimestamps();
    }

    public function scopeFilter(Builder $q, ?array $data = []): Builder
    {
        if (isset($data['name'])) {
            $q->where('name', 'like', '%' . $data['name'] . '%')->get();
        }
        if (isset($data['building_id'])) {
            $q->where('organizations.building_id', $data['building_id']);
        }
        if (isset($data['activity_id'])) {
            $q->whereHas('activities', function ($q) use ($data) {
                $q->where('id', $data['activity_id']);
            });
        }
        if (isset($data['activity_name'])) {
            $activities = Activity::with([
                    'children' => function ($q) {
                        $q->select('id', 'parent_id');
                    },
                    'children.children' => function ($q) {
                        $q->select('id', 'parent_id');
                    },
                ])
                ->where('name', 'like', '%' . $data['activity_name'] . '%')
                ->select('id')
                ->get()
                ->toArray();
            $activityIds = [];
            foreach ($activities as $activity) {
                if (!in_array($activity['id'], $activityIds)) {
                    $activityIds[] = $activity['id'];
                }
                foreach ($activity['children'] as $childActivity) {
                    if (!in_array($childActivity['id'], $activityIds)) {
                        $activityIds[] = $childActivity['id'];
                    }
                    foreach ($childActivity['children'] as $subChildActivity) {
                        if (!in_array($subChildActivity['id'], $activityIds)) {
                            $activityIds[] = $subChildActivity['id'];
                        }
                    }
                }
            }

            $q->whereHas('activities', function ($q) use ($activityIds) {
                $q->whereIn('id', $activityIds);
            });
        }
        if (isset($data['circle'])) {
            $q->whereHas('building', function ($q) use ($data) {
                $q->select('*', \DB::raw('(6371 * acos(
                        cos(radians('. $data['circle']['latitude'] . ')) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians('. $data['circle']['longitude'] . ')) +
                        sin(radians('. $data['circle']['latitude'] . ')) *
                        sin(radians(latitude))
                    )) as distance'))
                    ->having('distance', '<=', $data['circle']['radius']);
            });
        }
        if (isset($data['square'])) {
            $latitude = $data['square']['latitude'];
            $longitude = $data['square']['longitude'];
            $halfWidth = $data['square']['width'] / 2;
            $halfHeight = $data['square']['height'] / 2;

            $latitudeOffset = $halfHeight / 111;
            $longitudeOffset = $halfWidth / (111 * cos(deg2rad($latitude)));

            $q->whereHas('building', function ($q) use ($latitude, $latitudeOffset, $longitude, $longitudeOffset) {
                $q->whereBetween('latitude', [$latitude - $latitudeOffset, $latitude + $latitudeOffset])
                    ->whereBetween('longitude', [$longitude - $longitudeOffset, $longitude + $longitudeOffset]);
            });
        }

        return $q;
    }

    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }
}
