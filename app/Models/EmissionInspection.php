<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Database\Factories\EmissionInspectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmissionInspection extends Model
{
    /**
     * @use HasFactory<EmissionInspectionFactory>
     */
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'hc',
        'co',
        'lambda',
        'opacity',
        'result',
        'remarks',
        'inspected_by',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hc' => 'decimal:2',
            'co' => 'decimal:2',
            'lambda' => 'decimal:3',
            'opacity' => 'decimal:2',
            'result' => InspectionResult::class,
        ];
    }

    /**
     * @return BelongsTo<Inspection, EmissionInspection>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, EmissionInspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}
