<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;


class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'name_ar',
        'is_active',
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
