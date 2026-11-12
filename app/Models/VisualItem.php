<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisualItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'code',
        'standard',
        'category',
        'category_ar',
        'description',
        'description_ar',
        'sort_order',
        'is_active',
    ];


    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return HasMany<VisualItemResult, VisualItem>
     */
    public function visualItemResults(): HasMany
    {
        return $this->hasMany(VisualItemResult::class);
    }

    /**
     * @return BelongsToMany<InspectionType, VisualItem>
     */
    public function inspectionTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            InspectionType::class,
            'inspection_type_visual_item'
        )
            ->withPivot([
                'sort_order',
                'is_required',
            ])
            ->withTimestamps();
    }
}
