<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeadLightInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'left',
        'right',
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
            'result' => InspectionResult::class,
        ];
    }
    /**
     * @return BelongsTo<Inspection, HeadLightInspection>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, HeadLightInspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}
