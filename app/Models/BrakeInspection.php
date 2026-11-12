<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Database\Factories\BrakeInspectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrakeInspection extends Model
{
    /**
     * @use HasFactory<BrakeInspectionFactory>
     */
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

    /**
     * @return BelongsTo<Inspection, BrakeInspection>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, BrakeInspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}
