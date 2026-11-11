<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    protected function casts(): array
    {
        return [
            'result' => InspectionResult::class,
        ];
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }

    public function visualItemResults(): HasMany
    {
        return $this->hasMany(VisualItemResult::class);
    }
}
