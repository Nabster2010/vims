<?php

namespace App\Services;

use App\Enums\ComplianceStatus;
use App\Enums\CustomerType;
use App\Enums\InspectionResult;
use App\Models\Inspection;

class VehicleInformationComplianceCalculator
{
    public function calculate(Inspection $inspection): array
    {
        $failedItems = [];

        foreach ($this->checks($inspection) as $field) {

            $status = $inspection->vehicleInformation->{$field};

            if ($status !== ComplianceStatus::FAIL) {
                continue;
            }

            if (
                $field === 'fuel_economy_compliance'
                && $inspection->customer->customer_type === CustomerType::INDIVIDUAL
            ) {
                continue;
            }
            if (
                $field === 'vehicle_age_compliance'

            ) {
                continue;
            }

            $failedItems[] = $field;
        }

        return [
            'result' => empty($failedItems)
                ? InspectionResult::Pass
                : InspectionResult::Fail,

            'failedItems' => $failedItems,
        ];
    }

    protected function checks(Inspection $inspection): array
    {
        return match ($inspection->inspectionType->code) {

            'IMP' => [
                'vehicle_age_compliance',
                'fuel_economy_compliance',
            ],

            'SBR' => [
                'energy_efficiency_compliance',
                'fuel_economy_compliance',
                'vehicle_age_compliance',
                'is_vehicle_rare',
            ],
            default => [],
        };
    }
}
