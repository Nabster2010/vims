<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisualItemResult extends Model
{
    protected $fillable = [
        'visual_inspection_id',
        'visual_item_id',
        'result',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'result' => InspectionResult::class,
        ];
    }

    public function visualInspection(): BelongsTo
    {
        return $this->belongsTo(VisualInspection::class);
    }

    public function visualItem(): BelongsTo
    {
        return $this->belongsTo(VisualItem::class);
    }
}
