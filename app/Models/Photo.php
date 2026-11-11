<?php

namespace App\Models;

use App\Enums\PhotoType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'photo_type',
        'path',
        'remarks',
        'sort_order',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'photo_type' => PhotoType::class,
            'sort_order' => 'integer',
        ];
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
