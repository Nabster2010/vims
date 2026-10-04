<?php

namespace App\Models;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends Model
{
    protected $fillable = [
        'uuid',
        'inspection_no',
        'branch_id',
        'inspection_type_id',
        'customer_id',
        'sales_representative_id',
        'vin',
        'status',
        'created_by',
        'registered_at',
        'remarks',
    ];

    protected function casts(): array
    {
        return [

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
    public function importedVehicleRegistration(): HasOne
    {
        return $this->hasOne(ImportedVehicleRegistration::class);
    }
}
