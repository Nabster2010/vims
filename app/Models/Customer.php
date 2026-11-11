<?php

namespace App\Models;

use App\Enums\CustomerType;
use App\Enums\IdentityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'customer_type',
        'identity_type',
        'name',
        'identity_number',
        'vat_number',
        'mobile',
        'email',
        'address',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'customer_type' => CustomerType::class,
            'identity_type' => IdentityType::class,
            'is_active' => 'boolean',
        ];
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }

    public function scopeSearch($query, ?string $search)
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('identity_number', 'like', "%{$search}%")
                ->orWhere('mobile', 'like', "%{$search}%");
        });
    }
}
