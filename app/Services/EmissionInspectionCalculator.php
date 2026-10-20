<?php

namespace App\Services;

use App\Enums\FuelType;
use App\Enums\InspectionResult;

class EmissionInspectionCalculator
{
    public function calculate(
        FuelType $fuelType,
        array $values,
    ): ?array {

        $failedItems = [];
        // TODO fix this one to return array like other calculators
        if ($fuelType === FuelType::Ev) {
            return [
                'result' => null,
                'failedItems' => []
            ];
        }

        $limits = config("test-limits.emission.{$fuelType->value}");

        if (! $limits) {
            return [
                'result' => null,
                'failedItems' => []
            ];
        }

        foreach ($limits as $field => $limit) {

            $value = $values[$field] ?? null;

            // Ignore empty fields while user is typing
            if (blank($value)) {
                continue;
            }

            if (! $this->passes($value, $limit)) {

                $failedItems[] = $limit['label'];
            }
        }

        return [
            'result' => empty($failedItems)
                ? InspectionResult::Pass
                : InspectionResult::Fail,
            'failedItems' => $failedItems,
        ];
    }

    protected function passes(float|int $value, array $limit): bool
    {
        if (isset($limit['min']) && $value < $limit['min']) {
            return false;
        }

        if (isset($limit['max']) && $value > $limit['max']) {
            return false;
        }

        return true;
    }
}
