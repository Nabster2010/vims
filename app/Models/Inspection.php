<?php

namespace App\Models;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use Database\Factories\InspectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends Model
{
    /**
     * @use HasFactory<InspectionFactory>
     */
    use HasFactory;

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
        'request_origin',
        'modification_center_report_no',
        'modification_description',
        'is_authorized_modification_center',

        // Workflow
        'status',
        'final_result',
        'created_by',
        'registered_at',
        'approved_by',
        'approved_at',
        'is_locked',
        'reinspection_count',
        'remarks',
    ];

    // report number accessor - call it by $inspection->report_no
    protected $appends = [
        'report_no',
    ];

    public function getReportNoAttribute(): string
    {
        if ($this->reinspection_count === 0) {
            return $this->inspection_no;
        }

        return sprintf(
            '%s-R%d',
            $this->inspection_no,
            $this->reinspection_count,
        );
    }

    // reset vehicle information for a specific inspection when update inspection type keep common fields
    public function resetVehicleInformation(): void
    {
        $vehicle = $this->vehicleInformation;

        if (! $vehicle) {
            return;
        }
        $keep = [
            'inspection_date',
            'manufacturer_id',
            'model_type_id',
            'model_year',
            'fuel_type',
            'gearbox_type',
            'origin_country_id',
            'number_of_seats',
            'mileage',
            'remarks',
        ];
        $data = [];
        foreach ($vehicle->getFillable() as $field) {
            if (! in_array($field, $keep)) {
                $data[$field] = null;
            }
        }
        $vehicle->update($data);
    }

    public function resetEmissionInspection(): void
    {
        $this->emissionInspection()->delete();
        $this->update([
            'final_result' => InspectionResult::Pending,
            'status' => InspectionStatus::InProgress,
        ]);
    }

    protected static function booted(): void
    {
        static::updated(function (Inspection $inspection) {

            if (
                $inspection->getOriginal('inspection_type_id') !==
                $inspection->inspection_type_id
            ) {
                $inspection->resetVehicleInformation();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'request_date' => 'date',

            'custom_declaration_date' => 'date',

            'payment_amount' => 'decimal:2',

            'is_authorized_modification_center' => 'boolean',

            'status' => InspectionStatus::class,

            'final_result' => InspectionResult::class,

            'registered_at' => 'datetime',

            'inspection_started_at' => 'datetime',

            'inspection_completed_at' => 'datetime',

            'approved_at' => 'datetime',

            'is_locked' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Branch, Inspection>
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * @return BelongsTo<InspectionType, Inspection>
     */
    public function inspectionType(): BelongsTo
    {
        return $this->belongsTo(InspectionType::class);
    }

    /**
     * @return BelongsTo<Customer, Inspection>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<SalesRepresentative, Inspection>
     */
    public function salesRepresentative(): BelongsTo
    {
        return $this->belongsTo(SalesRepresentative::class);
    }

    /**
     * @return BelongsTo<CustomPort, Inspection>
     */
    public function customPort(): BelongsTo
    {
        return $this->belongsTo(CustomPort::class);
    }

    /**
     * @return BelongsTo<Country, Inspection>
     */
    public function importCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'import_country_id');
    }

    /**
     * @return BelongsTo<User, Inspection>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo<User, Inspection>
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    /**
     * @return BelongsTo<User, Inspection>
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * @return HasOne<VehicleInformation, Inspection>
     */
    public function vehicleInformation(): HasOne
    {
        return $this->hasOne(VehicleInformation::class);
    }

    /**
     * @return HasOne<EmissionInspection, Inspection>
     */
    public function emissionInspection(): HasOne
    {
        return $this->hasOne(EmissionInspection::class);
    }

    /**
     * @return HasOne<HeadLightInspection, Inspection>
     */
    public function headLightInspection(): HasOne
    {
        return $this->hasOne(HeadLightInspection::class);
    }

    public function sideSlipInspection(): HasOne
    {
        return $this->hasOne(SideSlipInspection::class);
    }

    public function suspensionInspection(): HasOne
    {
        return $this->hasOne(SuspensionInspection::class);
    }

    /**
     * @return HasOne<BrakeInspection, Inspection>
     */
    public function brakeInspection(): HasOne
    {
        return $this->hasOne(BrakeInspection::class);
    }

    /**
     * @return HasOne<VisualInspection, Inspection>
     */
    public function visualInspection(): HasOne
    {
        return $this->hasOne(VisualInspection::class);
    }

    /**
     * @return HasMany<Photo, Inspection>
     */
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)
            ->orderBy('sort_order');
    }

    /**
     * @param  Builder<Inspection>  $query
     * @return Builder<Inspection>
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query
                ->where('inspection_no', 'like', "%{$search}%")
                ->orWhere('vin', 'like', "%{$search}%")
                ->orWhere('request_no', 'like', "%{$search}%")
                ->orWhereHas('customer', function (Builder $query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('identity_number', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%");
                })
                ->orWhereHas('vehicleInformation.modelType', function (Builder $query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%");
                });
        });
    }

    /**
     * @param  Builder<Inspection>  $query
     * @return Builder<Inspection>
     */
    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        if (blank($status)) {
            return $query;
        }

        return $query->where('status', InspectionStatus::from($status));
    }

    /**
     * @param  Builder<Inspection>  $query
     * @return Builder<Inspection>
     */
    public function scopeFilterInspectionTypeId(Builder $query, ?int $inspectionTypeId): Builder
    {
        if (blank($inspectionTypeId)) {
            return $query;
        }

        return $query->where('inspection_type_id', $inspectionTypeId);
    }
}
