<?php

namespace App\Models;

use Database\Factories\ModelTypeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelType extends Model
{
    /**
     * @use HasFactory<ModelTypeFactory>
     */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'manufacturer_id',
        'name',
        'name_ar',
        'is_active',
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
     * @return BelongsTo<Manufacturer, ModelType>
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * @return HasMany<VehicleInformation, ModelType>
     */
    public function vehicleInformation(): HasMany
    {
        return $this->hasMany(VehicleInformation::class);
    }

    /**
     * @param  Builder<ModelType>  $query
     * @return Builder<ModelType>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
