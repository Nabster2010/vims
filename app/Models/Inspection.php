<?php

namespace App\Models;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends Model
{
    protected $fillable = [
        // System
        'uuid',
        'inspection_no',

        // Relations
        'branch_id',
        'inspection_type_id',
        'customer_id',
        'sales_representative_id',

        // common
        'vin',
        'payment_type',
        'payment_amount',
        'request_no',
        'request_date',

        // Imported Vehicles
        'custom_declaration_no',
        'custom_declaration_date',
        'custom_port_id',

        // saber
        'import_country_id',

        // Modified Vehicles
        'plate_no',
        'modification_center',
        'current_type',
        'target_type',
        'owner_id',

        // Workflow
        'status',
        'created_by',
        'registered_at',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'request_date' => 'date',

            'custom_declaration_date' => 'date',

            'payment_amount' => 'decimal:2',

            'status' => InspectionStatus::class,

            'final_result' => InspectionResult::class,

            'registered_at' => 'datetime',

            'inspection_started_at' => 'datetime',

            'inspection_completed_at' => 'datetime',

            'approved_at' => 'datetime',

            'is_locked' => 'boolean',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function inspectionType(): BelongsTo
    {
        return $this->belongsTo(InspectionType::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesRepresentative(): BelongsTo
    {
        return $this->belongsTo(SalesRepresentative::class);
    }

    public function customPort(): BelongsTo
    {
        return $this->belongsTo(CustomPort::class);
    }

    public function importCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'import_country_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function vehicleInformation(): HasOne
    {
        return $this->hasOne(VehicleInformation::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query
                ->where('inspection_no', 'like', "%{$search}%")
                ->orWhere('vin', 'like', "%{$search}%")
                ->orWhereHas('customer', function (Builder $query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('identity_number', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%");
                });
        });
    }
    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        if (blank($status)) {
            return $query;
        }
        return $query->where('status', InspectionStatus::from($status));
    }
    public function scopeFilterInspectionTypeId(Builder $query, ?int $inspectionTypeId): Builder
    {
        if (blank($inspectionTypeId)) {
            return $query;
        }
        return $query->where('inspection_type_id', $inspectionTypeId);
    }
}
