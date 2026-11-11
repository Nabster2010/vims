<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function visualItemResults(): HasMany
    {
        return $this->hasMany(VisualItemResult::class);
    }
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
