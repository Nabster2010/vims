<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelType extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'manufacturer_id',
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
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
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
