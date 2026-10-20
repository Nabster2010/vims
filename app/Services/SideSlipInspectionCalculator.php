<?php

namespace App\Services;

use App\Enums\InspectionResult;

class SideSlipInspectionCalculator
{
    public function calculate(
        array $values,
    ): array {
        $failedItems = [];

        $limits = config("test-limits.sideSlip");

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
