<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SideSlipInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'value',
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
