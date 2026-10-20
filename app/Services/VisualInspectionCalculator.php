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

                $visualItem = VisualItem::find($visualItemId);

                $failedItems[] = [
                    'id' => $visualItemId,
                    'name' => $visualItem?->name,
                    'name_ar' => $visualItem?->name_ar,
                ];
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
