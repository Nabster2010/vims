<?php

namespace App\Models;

use App\Enums\PhotoType;
use Database\Factories\PhotoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    /**
     * @use HasFactory<PhotoFactory>
     */
    use HasFactory;

    protected $fillable = [
        'inspection_id',
        'photo_type',
        'path',
        'remarks',
        'sort_order',
        'uploaded_by',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'photo_type' => PhotoType::class,
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Inspection, Photo>
     */
    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * @return BelongsTo<User, Photo>
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
