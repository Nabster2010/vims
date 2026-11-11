<?php

namespace Database\Factories;

use App\Enums\ComplianceStatus;
use App\Enums\FuelType;
use App\Enums\GearboxType;
use App\Enums\VehicleCondition;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Inspection;
use App\Models\Manufacturer;
use App\Models\ModelType;
use App\Models\User;
use App\Models\VehicleInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleInformationFactory extends Factory
{
    protected $model = VehicleInformation::class;

    public function definition(): array
    {
        return [

            'inspection_id' => Inspection::factory(),

            'inspection_date' => today(),

            'manufacturer_id' => Manufacturer::factory(),

            'model_type_id' => ModelType::factory(),

            'model_year' => fake()->numberBetween(2020, now()->year),

            'color_id' => Color::factory(),

            'origin_country_id' => Country::factory(),

            'fuel_type' => FuelType::Gasoline,

            'gearbox_type' => GearboxType::Automatic,

            'category_id' => Category::factory(),

            'vehicle_condition' => VehicleCondition::Used,

            'number_of_seats' => 5,

            'mileage' => fake()->numberBetween(0, 250000),

            'energy_efficiency_compliance' => ComplianceStatus::PASS,

            'fuel_economy_compliance' => ComplianceStatus::PASS,

            'vehicle_age_compliance' => ComplianceStatus::PASS,

            'is_vehicle_rare' => ComplianceStatus::PASS,

            'inspected_by' => User::factory(),
        ];
    }

    public function electric(): static
    {
        return $this->state(fn () => [
            'fuel_type' => FuelType::Ev,
        ]);
    }

    public function diesel(): static
    {
        return $this->state(fn () => [
            'fuel_type' => FuelType::Diesel,
        ]);
    }

    public function hybrid(): static
    {
        return $this->state(fn () => [
            'fuel_type' => FuelType::Hybrid,
        ]);
    }
}
