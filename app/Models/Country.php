<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'iso2',
        'iso3',
        'is_active',
    ];
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function productionVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'production_country_id'
        );
    }

    public function originVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'origin_country_id'
        );
    }

    public function shipmentVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'shipment_country_id'
        );
    }
}
