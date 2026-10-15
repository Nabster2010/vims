<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPort extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'code',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
