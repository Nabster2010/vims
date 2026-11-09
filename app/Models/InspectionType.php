<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionType extends Model
{
    protected $fillable = [
        'code',
        'name',
        'name_ar',
        'prefix',
        'is_active',
        'description',
    ];
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
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
    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
