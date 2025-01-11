<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'adres_1',
        'adres_2',
        'latitude',
        'longitude',
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, 'building_id', 'id');
    }
}
