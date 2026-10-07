<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomPort extends Model
{
    public function importedVehicleRegistrations(): HasMany
    {
        return $this->hasMany(ImportedVehicleRegistration::class);
    }
}
