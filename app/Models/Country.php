<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'iso2',
        'iso3',
        'is_active',
    ];
}
