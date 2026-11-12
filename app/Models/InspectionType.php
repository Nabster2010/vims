<?php

namespace App\Models;

use Database\Factories\InspectionTypeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionType extends Model
{
    /**
     * @use HasFactory<InspectionTypeFactory>
     */
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'name_ar',
        'prefix',
        'is_active',
        'description',
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
     * @return BelongsToMany<VisualItem, InspectionType>
     */
    public function visualItems(): BelongsToMany
    {
        return $this->belongsToMany(
            VisualItem::class,
            'inspection_type_visual_item'
        )
            ->withPivot([
                'sort_order',
                'is_required',
            ])
            ->orderByPivot('sort_order')
            ->withTimestamps();
    }

    /**
     * @return HasMany<Inspection, InspectionType>
     */
    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * @param  Builder<InspectionType>  $query
     * @return Builder<InspectionType>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
