<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'name_ar',
        'is_active',
        'country_id',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function modelTypes(): HasMany
    {
        return $this->hasMany(ModelType::class);
    }

    public function vehicleInformation(): HasMany
    {
        return $this->hasMany(VehicleInformation::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
