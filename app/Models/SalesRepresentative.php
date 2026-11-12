<?php

namespace App\Models;

use Database\Factories\SalesRepresentativeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesRepresentative extends Model
{
    /**
     * @use HasFactory<SalesRepresentativeFactory>
     */
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'mobile',
        'email',
        'notes',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<Inspection, SalesRepresentative>
     */
    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * @param  Builder<SalesRepresentative>  $query
     * @return Builder<SalesRepresentative>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
