<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisualItemResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'visual_inspection_id',
        'visual_item_id',
        'result',
        'is_modified',
        'remarks',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'result' => InspectionResult::class,
            'is_modified' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<VisualInspection, VisualItemResult>
     */
    public function visualInspection(): BelongsTo
    {
        return $this->belongsTo(VisualInspection::class);
    }

    /**
     * @return BelongsTo<VisualItem, VisualItemResult>
     */
    public function visualItem(): BelongsTo
    {
        return $this->belongsTo(VisualItem::class);
    }
}
