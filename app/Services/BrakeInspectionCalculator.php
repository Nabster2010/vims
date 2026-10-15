<?php

namespace App\Services;

use App\Enums\InspectionResult;

class BrakeInspectionCalculator
{
    public function calculate(
        array $values,
    ): ?InspectionResult {


        $limits = config("test-limits.brake");

        foreach ($limits as $field => $limit) {

            $value = $values[$field] ?? null;

            // Ignore empty fields while user is typing
            if ($value === null || $value === '') {
                continue;
            }

            if (! $this->passes($value, $limit)) {
                return InspectionResult::Fail;
            }
        }

        return InspectionResult::Pass;
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
