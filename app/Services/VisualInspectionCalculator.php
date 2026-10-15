<?php

namespace App\Services;

use App\Enums\InspectionResult;

class VisualInspectionCalculator
{
    public function calculate(
        array $items,
    ): ?InspectionResult {

        if (empty($items)) {
            return null;
        }

        $hasValues = false;

        foreach ($items as $item) {
            $result = $item['result'] ?? null;

            if ($result === null || $result === '') {
                continue;
            }

            $hasValues = true;

            if ($result === InspectionResult::Fail->value || $result === InspectionResult::Fail) {
                return InspectionResult::Fail;
            }
        }

        if (! $hasValues) {
            return null;
        }

        return InspectionResult::Pass;
    }
}
