<?php

namespace App\Models;

use App\Enums\AirIntake;
use App\Enums\BodyType;
use App\Enums\ComplianceStatus;
use App\Enums\DriveLine;
use App\Enums\FuelType;
use App\Enums\GearboxType;
use App\Enums\MotorcycleCategory;
use App\Enums\MotorcycleUse;
use App\Enums\VehicleCondition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleInformation extends Model
{
    use HasFactory;

    protected $table = 'vehicle_information';

    protected $fillable = [
        'inspection_id',
        'inspection_date',
        'manufacturer_id',
        'model_type_id',
        'model_division',
        'manufacturing_year',
        'manufacturing_month',
        'model_year',
        'motorcycle_category',
        'color_id',
        'production_country_id',
        'origin_country_id',
        'shipment_country_id',
        'fuel_type',
        'gearbox_type',
        'drive_line',
        'category_id',
        'air_intake',
        'vehicle_condition',
        'service_brake',
        'emergency_brake',
        'engine_no',
        'engine_displacement',
        'engine_power',
        'engine_power_rpm',
        'number_of_cylinders',
        'electric_motor_power',
        'battery_type',
        'battery_capacity',
        'battery_voltage',
        'battery_charge_time',
        'electric_consumption',
        'number_of_seats',
        'mileage',
        'number_of_doors',
        'number_of_axles',
        'gross_weight',
        'curb_weight',
        'load_weight',
        'front_axle_weight',
        'rear_axle_weight',
        'other_axle_weight',
        'wheelbase',
        'width',
        'height',
        'length',
        'front_track_width',
        'rear_track_width',
        'motorcycle_use',
        'maximum_speed',
        'front_brake',
        'rear_brake',
        'fuel_economy',
        'equivalent_fuel_economy',
        'energy_efficiency_compliance',
        'fuel_economy_compliance',
        'vehicle_age_compliance',
        'is_vehicle_rare',
        'remarks',
        'inspected_by',
    ];

    protected function casts(): array
    {
        return [
            'fuel_type' => FuelType::class,
            'gearbox_type' => GearboxType::class,
            'drive_line' => DriveLine::class,
            'body_type' => BodyType::class,
            'air_intake' => AirIntake::class,
            'vehicle_condition' => VehicleCondition::class,
            'motorcycle_use' => MotorcycleUse::class,
            'motorcycle_category' => MotorcycleCategory::class,
            'inspection_date' => 'date',
            'energy_efficiency_compliance' => ComplianceStatus::class,
            'fuel_economy_compliance' => ComplianceStatus::class,
            'vehicle_age_compliance' => ComplianceStatus::class,
            'is_vehicle_rare' => ComplianceStatus::class,
        ];
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function modelType(): BelongsTo
    {
        return $this->belongsTo(ModelType::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function productionCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'production_country_id');
    }

    public function originCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'origin_country_id');
    }

    public function shipmentCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'shipment_country_id');
    }

    public function inspector(): BelongsTo
    {

        return $this->belongsTo(User::class, 'inspected_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
