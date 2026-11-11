<?php

namespace Database\Factories;

use App\Enums\ComplianceStatus;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleInformationFactory extends Factory
{
    public function definition(): array
    {
        return [

            'inspection_id' => Inspection::factory(),

            'vehicle_age_compliance' => ComplianceStatus::PASS,

            'fuel_economy_compliance' => ComplianceStatus::PASS,

            'energy_efficiency_compliance' => ComplianceStatus::PASS,

            'is_vehicle_rare' => ComplianceStatus::PASS,
        ];
    }

    public function failedVehicleAge(): static
    {
        return $this->state(fn() => [
            'vehicle_age_compliance' => ComplianceStatus::FAIL,
        ]);
    }

    public function failedFuelEconomy(): static
    {
        return $this->state(fn() => [
            'fuel_economy_compliance' => ComplianceStatus::FAIL,
        ]);
    }

    public function failedEnergyEfficiency(): static
    {
        return $this->state(fn() => [
            'energy_efficiency_compliance' => ComplianceStatus::FAIL,
        ]);
    }

    public function rareVehicle(): static
    {
        return $this->state(fn() => [
            'is_vehicle_rare' => ComplianceStatus::FAIL,
        ]);
    }
}
