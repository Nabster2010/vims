<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesRepresentative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'mobile',
        'email',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
