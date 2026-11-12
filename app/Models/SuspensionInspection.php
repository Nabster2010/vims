<?php

namespace App\Models;

use App\Enums\InspectionResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuspensionInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'front_left',
        'front_right',
        'rear_left',
        'rear_right',
        'result',
        'inspected_by',
        'remarks',
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
     * @return BelongsTo<Inspection, SuspensionInspection>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, SuspensionInspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}
