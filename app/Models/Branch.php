<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'uuid',
        'name',
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

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
