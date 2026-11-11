<?php

namespace App\Services\Inspection;

use App\Enums\FuelType;
use App\Enums\InspectionModule;
use App\Models\Inspection;

class InspectionRequiredModulesService
{
    public function modules(Inspection $inspection): array
    {
        $fuelType = $inspection->vehicleInformation?->fuel_type;
        $inspection->loadMissing('inspectionType');

        $modules = config(
            "inspection-modules.{$inspection->inspectionType->code}",
            [],
        );
        if ($fuelType === FuelType::Ev) {
            $modules = array_filter($modules, fn ($module) => $module !== InspectionModule::EmissionInspection);
        }

        return $modules;
    }
}
