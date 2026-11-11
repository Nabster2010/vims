<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BrakeInspection extends Model
{
    use HasFactory;
    protected $fillable = [
        'inspection_id',
        'front',
        'rear',
        'parking',
        'result',
        'inspected_by',
        'remarks',
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
}
