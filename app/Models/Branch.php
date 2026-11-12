<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'name_ar',
        'code',
        'address',
        'manager_id',
        'phone',
        'email',
        'logo_path',
        'stamp_path',
        'last_inspection_sequence',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @return HasMany<Inspection, Branch>
     */
    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * @return BelongsTo<User, Branch>
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    /**
     * @return HasMany<User, Branch>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
