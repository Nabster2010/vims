<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomPort extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_ar',
        'code',
        'is_active',
    ];
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
