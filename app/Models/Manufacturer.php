<?php

namespace App\Models;

use Database\Factories\ManufacturerFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    /**
     * @use HasFactory<ManufacturerFactory>
     */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'name_ar',
        'is_active',
        'country_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<ModelType, Manufacturer>
     */
    public function modelTypes(): HasMany
    {
        return $this->hasMany(ModelType::class);
    }

    /**
     * @return HasMany<VehicleInformation, Manufacturer>
     */
    public function vehicleInformation(): HasMany
    {
        return $this->hasMany(VehicleInformation::class);
    }

    /**
     * @return BelongsTo<Country, Manufacturer>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @param  Builder<Manufacturer>  $query
     * @return Builder<Manufacturer>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
