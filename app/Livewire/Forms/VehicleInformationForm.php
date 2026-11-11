<?php

namespace App\Livewire\Forms;

use App\Enums\AirIntake;
use App\Enums\ComplianceStatus;
use App\Enums\DriveLine;
use App\Enums\FuelType;
use App\Enums\GearboxType;
use App\Enums\MotorcycleCategory;
use App\Enums\MotorcycleUse;
use App\Enums\VehicleCondition;
use App\Models\Inspection;
use App\Models\VehicleInformation;
use App\Services\Inspection\InspectionWorkflowService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class VehicleInformationForm extends Form
{
    /**
     * Current inspection type code
     */
    protected ?string $inspectionTypeCode = null;

    public ?string $inspection_date = null;

    public ?int $manufacturer_id = null;

    public ?int $model_type_id = null;

    public ?string $model_division = null;

    public ?int $manufacturing_year = null;

    public ?int $manufacturing_month = null;

    public ?int $model_year = null;

    public ?MotorcycleCategory $motorcycle_category = null;

    public ?int $color_id = null;

    public ?int $production_country_id = null;

    public ?int $origin_country_id = null;

    public ?int $shipment_country_id = null;

    public ?FuelType $fuel_type = FuelType::Gasoline;

    public ?GearboxType $gearbox_type = GearboxType::Automatic;

    public ?DriveLine $drive_line = null;

    public ?int $category_id = null;

    public ?AirIntake $air_intake = null;

    public ?VehicleCondition $vehicle_condition = null;

    public ?string $service_brake = null;

    public ?string $emergency_brake = null;

    public ?string $engine_no = null;

    public ?int $engine_displacement = null;

    public ?int $engine_power = null;

    public ?int $engine_power_rpm = null;

    public ?int $number_of_cylinders = null;

    public ?int $electric_motor_power = null;

    public ?string $battery_type = null;

    public ?float $battery_capacity = null;

    public ?int $battery_voltage = null;

    public ?int $battery_charge_time = null;

    public ?float $electric_consumption = null;

    public ?int $number_of_seats = null;

    public ?int $mileage = null;

    public ?int $number_of_doors = null;

    public ?int $number_of_axles = null;

    public ?int $gross_weight = null;

    public ?int $curb_weight = null;

    public ?int $load_weight = null;

    public ?int $front_axle_weight = null;

    public ?int $rear_axle_weight = null;

    public ?int $other_axle_weight = null;

    public ?int $wheelbase = null;

    public ?int $width = null;

    public ?int $height = null;

    public ?int $length = null;

    public ?int $front_track_width = null;

    public ?int $rear_track_width = null;

    public ?MotorcycleUse $motorcycle_use = null;

    public ?int $maximum_speed = null;

    public ?string $front_brake = null;

    public ?string $rear_brake = null;

    public ?float $fuel_economy = null;

    public ?int $equivalent_fuel_economy = null;

    public ?ComplianceStatus $energy_efficiency_compliance = ComplianceStatus::PASS;

    public ?ComplianceStatus $fuel_economy_compliance = ComplianceStatus::PASS;

    public ?ComplianceStatus $vehicle_age_compliance = ComplianceStatus::PASS;

    public ?ComplianceStatus $is_vehicle_rare = ComplianceStatus::PASS;

    public ?string $remarks = null;

    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        // load relations
        $inspection->loadMissing('inspectionType', 'vehicleInformation');
        $this->inspectionTypeCode = $inspection->inspectionType->code;
        $vehicle = $inspection->vehicleInformation;
        if (! $vehicle) {
            $this->inspection_date = today()->toDateString();
            $this->vehicle_condition = VehicleCondition::Used;

            return;
        }

        foreach ($vehicle->getAttributes() as $attribute => $value) {
            $this->{$attribute} = $vehicle->{$attribute};
        }
        $this->inspection_date = $vehicle->inspection_date?->format('Y-m-d');
    }

    public function data(): array
    {
        return $this->all();
    }

    // function to get return an array of inspection Types

    /**
     * Validation Rules
     */
    protected function rules(): array
    {
        $rules = [
            'inspection_date' => ['required', 'date'],
            'manufacturer_id' => ['required', 'exists:manufacturers,id'],
            'model_type_id' => ['required', 'exists:model_types,id'],
            'model_year' => ['required', 'integer'],
            'color_id' => ['required', 'exists:colors,id'],
            'fuel_type' => ['required', new Enum(FuelType::class)],
            'gearbox_type' => ['required', new Enum(GearboxType::class)],
            'origin_country_id' => ['required', 'exists:countries,id'],
            'number_of_seats' => ['required', 'integer'],
            'mileage' => ['required', 'integer', 'min:0'],
            'remarks' => ['nullable', 'string'],
        ];
        switch ($this->inspectionTypeCode) {
            case 'IMP':
                $rules += [
                    'category_id' => ['required', 'exists:categories,id'],
                    'vehicle_condition' => ['required', new Enum(VehicleCondition::class)],
                    'number_of_cylinders' => ['nullable', 'integer'],
                    'engine_displacement' => ['nullable', 'integer'],
                    'energy_efficiency_compliance' => ['required', new Enum(ComplianceStatus::class)],
                    'vehicle_age_compliance' => ['required', new Enum(ComplianceStatus::class)],
                ];

                break;

            case 'SBR':
                $rules += [
                    'model_division' => ['required', 'string'],
                    'manufacturing_year' => ['required', 'integer'],
                    'category_id' => ['required', 'exists:categories,id'],
                    'air_intake' => ['required', new Enum(AirIntake::class)],
                    'drive_line' => ['required', new Enum(DriveLine::class)],
                    'shipment_country_id' => ['required', 'exists:countries,id'],
                    'production_country_id' => ['required', 'exists:countries,id'],
                    'number_of_doors' => ['required', 'integer'],
                    'engine_displacement' => ['required', 'integer'],
                    'engine_power' => ['required', 'integer'],
                    'number_of_cylinders' => ['required', 'integer'],
                    'number_of_axles' => ['required', 'integer'],
                    'front_axle_weight' => ['required', 'integer'],
                    'rear_axle_weight' => ['required', 'integer'],
                    'front_track_width' => ['required', 'integer'],
                    'rear_track_width' => ['required', 'integer'],
                    'gross_weight' => ['required', 'integer'],
                    'curb_weight' => ['required', 'integer'],
                    'load_weight' => ['required', 'integer'],
                    'wheelbase' => ['required', 'integer'],
                    'width' => ['required', 'integer'],
                    'height' => ['required', 'integer'],
                    'length' => ['required', 'integer'],
                    'service_brake' => ['required', 'string'],
                    'emergency_brake' => ['required', 'string'],
                    // compliance
                    'energy_efficiency_compliance' => ['required', new Enum(ComplianceStatus::class)],
                    'fuel_economy_compliance' => ['required', new Enum(ComplianceStatus::class)],
                    'vehicle_age_compliance' => ['required', new Enum(ComplianceStatus::class)],
                    'is_vehicle_rare' => ['required', new Enum(ComplianceStatus::class)],
                    // specific
                    'fuel_economy' => ['required', 'numeric'],
                ];
                if (in_array($this->fuel_type, [FuelType::Diesel, FuelType::Gasoline, FuelType::Hybrid, FuelType::Phev])) {

                    $rules += [
                        'fuel_economy' => ['required', 'numeric'],
                    ];
                } else {
                    $rules += [
                        'equivalent_fuel_economy' => ['required', 'integer'],
                    ];
                }
                if (in_array($this->fuel_type, [FuelType::Phev, FuelType::Ev])) {

                    $rules += [
                        'electric_motor_power' => ['required', 'integer'],
                        'battery_type' => ['required', 'string', 'max:255'],
                        'battery_capacity' => ['required', 'numeric'],
                        'battery_voltage' => ['required', 'integer'],
                        'battery_charge_time' => ['required', 'integer'],
                        'electric_consumption' => ['required', 'numeric'],
                    ];
                }

                break;

            case 'MTC':
                $rules += [
                    'motorcycle_use' => ['required', new Enum(MotorcycleUse::class)],
                    'motorcycle_category' => ['required', new Enum(MotorcycleCategory::class)],
                    'maximum_speed' => ['required', 'integer'],
                    'model_division' => ['nullable', 'string', 'max:255'],
                    'manufacturing_year' => ['required', 'integer'],
                    'manufacturing_month' => ['required', 'integer'],
                    'mileage' => ['required', 'integer'],
                    'shipment_country_id' => ['required', 'exists:countries,id'],
                    'production_country_id' => ['required', 'exists:countries,id'],
                    'engine_displacement' => ['required', 'integer'],
                    'engine_power' => ['required', 'integer'],
                    'engine_power_rpm' => ['required', 'integer'],
                    'number_of_cylinders' => ['required', 'integer'],
                    'gross_weight' => ['required', 'integer'],
                    'curb_weight' => ['required', 'integer'],
                    'load_weight' => ['required', 'integer'],
                    'wheelbase' => ['required', 'integer'],
                    'width' => ['required', 'integer'],
                    'height' => ['required', 'integer'],
                    'length' => ['required', 'integer'],
                    'front_brake' => ['required', 'string', 'max:255'],
                    'rear_brake' => ['required', 'string', 'max:255'],

                ];

                break;
            case 'MDH':

                $rules += [
                    'number_of_seats' => ['required', 'integer', 'min:1'],
                    'engine_no' => ['nullable', 'string'],
                    'number_of_cylinders' => ['nullable', 'integer', 'min:1'],
                    'engine_displacement' => ['nullable', 'integer', 'min:1'],
                    'category_id' => ['required', 'exists:categories,id'],
                    'gross_weight' => ['required', 'integer', 'min:1'],
                    'width' => ['required', 'integer', 'min:1'],
                    'height' => ['required', 'integer', 'min:1'],
                    'length' => ['required', 'integer', 'min:1'],
                    'number_of_axles' => ['required', 'integer', 'min:1'],
                    'front_axle_weight' => ['nullable', 'integer', 'min:1'],
                    'rear_axle_weight' => ['nullable', 'integer', 'min:1'],
                    'other_axle_weight' => ['nullable', 'integer', 'min:1'],

                ];

                break;
            case 'MDL':

                $rules += [
                    'number_of_seats' => ['required', 'integer', 'min:1'],
                    'engine_no' => ['nullable', 'string', 'max:100'],
                    'number_of_cylinders' => ['nullable', 'integer', 'min:1'],
                    'engine_displacement' => ['nullable', 'integer', 'min:1'],
                    'category_id' => ['required', 'exists:categories,id'],
                    'gross_weight' => ['required', 'integer', 'min:1'],
                    'width' => ['required', 'integer', 'min:1'],
                    'height' => ['required', 'integer', 'min:1'],
                    'length' => ['required', 'integer', 'min:1'],
                    'number_of_axles' => ['required', 'integer', 'min:1'],
                    'front_axle_weight' => ['nullable', 'integer', 'min:1'],
                    'rear_axle_weight' => ['nullable', 'integer', 'min:1'],
                    'other_axle_weight' => ['nullable', 'integer', 'min:1'],

                ];

                break;
            case 'TRL':

                $rules = [
                    'inspection_date' => ['required', 'date'],
                    'manufacturer_id' => ['required', 'exists:manufacturers,id'],
                    'model_type_id' => ['nullable', 'exists:model_types,id'],
                    'model_division' => ['nullable', 'string', 'max:255'],
                    'model_year' => ['required', 'integer'],
                    'color_id' => ['required', 'exists:colors,id'],
                    'origin_country_id' => ['required', 'exists:countries,id'],
                    'gross_weight' => ['required', 'integer', 'min:1'],
                    'width' => ['required', 'integer', 'min:1'],
                    'height' => ['required', 'integer', 'min:1'],
                    'length' => ['required', 'integer', 'min:1'],
                    'number_of_axles' => ['required', 'integer', 'min:1'],
                    'front_axle_weight' => ['required', 'integer', 'min:1'],
                    'rear_axle_weight' => ['required', 'integer', 'min:1'],
                    'other_axle_weight' => ['nullable', 'integer', 'min:1'],
                    'remarks' => ['nullable', 'string'],

                ];

                break;
        }

        return $rules;
    }

    /**
     * Save
     */
    public function save(Inspection $inspection): VehicleInformation
    {

        $this->inspectionTypeCode = $inspection->inspectionType->code;
        $this->validate();
        $oldFuelType = $inspection->vehicleInformation?->fuel_type;
        $vehicle = $inspection->vehicleInformation()->updateOrCreate(
            [],
            [
                ...$this->all(),
                'inspected_by' => Auth::id(),
            ]
        );

        if ($oldFuelType !== $this->fuel_type) {
            $inspection->resetEmissionInspection();
        }
        app(InspectionWorkflowService::class)
            ->sync($inspection);

        return $vehicle;
    }
}
