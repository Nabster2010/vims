<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisualInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'result',
        'inspected_by',
        'remarks',
        'description',
        'description_ar',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'result' => InspectionResult::class,
        ];
    }

    /**
     * @return BelongsTo<Inspection, VisualInspection>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, VisualInspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }

    /**
     * @return HasMany<VisualItemResult, VisualInspection>
     */
    public function visualItemResults(): HasMany
    {
        return $this->hasMany(VisualItemResult::class);
    }
}
