<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InspectionType extends Model
{
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
}
