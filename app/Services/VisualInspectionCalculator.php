<?php

namespace App\Services;

use App\Enums\InspectionResult;
use App\Models\VisualItem;

class VisualInspectionCalculator
{
    public function calculate(array $items): array
    {
        if (empty($items)) {
            return [
                'result' => null,
                'failedItems' => [],
            ];
        }

        $failedItems = [];
        $hasValues = false;

        $names = VisualItem::whereIn('id', array_keys($items))
            ->pluck('name', 'id');

        foreach ($items as $visualItemId => $item) {

            $result = $item['result'] ?? null;

            if (blank($result)) {
                continue;
            }

            $hasValues = true;

            if (
                $result === InspectionResult::Fail->value ||
                $result === InspectionResult::Fail
            ) {

                $failedItems[] = $names[$visualItemId] ?? null;
            }
        }

        return [
            'result' => ! $hasValues
                ? null
                : (empty($failedItems)
                    ? InspectionResult::Pass
                    : InspectionResult::Fail),

            'failedItems' => $failedItems,
        ];
    }
}
