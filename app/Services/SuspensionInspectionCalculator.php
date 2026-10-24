<?php

namespace App\Services;

use App\Enums\InspectionResult;

class SuspensionInspectionCalculator
{
    public function calculate(
        array $values,
    ): array {

        $hasInput = false;
        $failedItems = [];

        $limits = config("test-limits.suspension");

        foreach ($limits as $field => $limit) {

            $value = $values[$field] ?? null;

            // Ignore empty fields while user is typing
            if (blank($value)) {
                continue;
            }

            $hasInput = true;

            if (! $this->passes($value, $limit)) {
                $failedItems[] = $limit['label'];
            }
        }

        if (! $hasInput) {
            return [
                'result' => InspectionResult::Pending,
                'failedItems' => [],
            ];
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
