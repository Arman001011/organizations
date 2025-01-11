<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }

    protected $fillable = [
        'name',
        'phone_numbers',
        'building_id',
        'status',
    ];

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class)->withTimestamps();
    }
}
