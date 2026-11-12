<?php

namespace App\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    /**
     * @use HasFactory<CountryFactory>
     */
    use HasFactory;

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

    /**
     * @return HasMany<VehicleInformation, Country>
     */
    public function productionVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'production_country_id'
        );
    }

    /**
     * @return HasMany<VehicleInformation, Country>
     */
    public function originVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'origin_country_id'
        );
    }

    /**
     * @return HasMany<VehicleInformation, Country>
     */
    public function shipmentVehicles(): HasMany
    {
        return $this->hasMany(
            VehicleInformation::class,
            'shipment_country_id'
        );
    }
}
