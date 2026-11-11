<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmissionInspection extends Model
{
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

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }
    public function inspector(): BelongsTo

    {

        return $this->belongsTo(User::class, 'inspected_by');
    }
}
