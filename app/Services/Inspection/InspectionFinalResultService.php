<?php

namespace App\Services\Inspection;

use App\Enums\InspectionModule;
use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\BrakeInspectionCalculator;
use App\Services\EmissionInspectionCalculator;
use App\Services\HeadLightInspectionCalculator;
use App\Services\SideSlipInspectionCalculator;
use App\Services\SuspensionInspectionCalculator;
use App\Services\VisualInspectionCalculator;

class InspectionFinalResultService
{
    public function calculate(Inspection $inspection): array
    {
        $inspection->loadMissing([
            'vehicleInformation',
            'emissionInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'brakeInspection',
            'visualInspection.visualItemResults',
        ]);

        $requiredModules = $this->requiredModules($inspection);

        $failedModules = [];
        $failedItems = [];

        foreach ($requiredModules as $module) {

            switch ($module) {

                /*
                |--------------------------------------------------------------------------
                | Brake Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::BrakeInspection:

                    if (! $inspection->brakeInspection) {
                        break;
                    }

                    $result = app(BrakeInspectionCalculator::class)->calculate([
                        'front' => $inspection->brakeInspection->front,
                        'rear' => $inspection->brakeInspection->rear,
                        'parking' => $inspection->brakeInspection->parking,
                    ]);

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;

                /*
                |--------------------------------------------------------------------------
                | Emission Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::EmissionInspection:

                    if (
                        ! $inspection->vehicleInformation ||
                        ! $inspection->emissionInspection
                    ) {
                        break;
                    }

                    $result = app(EmissionInspectionCalculator::class)->calculate(
                        $inspection->vehicleInformation->fuel_type,
                        [
                            'hc' => $inspection->emissionInspection->hc,
                            'co' => $inspection->emissionInspection->co,
                            'lambda' => $inspection->emissionInspection->lambda,
                            'opacity' => $inspection->emissionInspection->opacity,
                        ]
                    );

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;

                /*
                |--------------------------------------------------------------------------
                | Head Light Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::HeadLightInspection:

                    if (! $inspection->headLightInspection) {
                        break;
                    }

                    $result = app(HeadLightInspectionCalculator::class)->calculate([
                        'left' => $inspection->headLightInspection->left,
                        'right' => $inspection->headLightInspection->right,
                    ]);

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;

                /*
                |--------------------------------------------------------------------------
                | Side Slip Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::SideSlipInspection:

                    if (! $inspection->sideSlipInspection) {
                        break;
                    }

                    $result = app(SideSlipInspectionCalculator::class)->calculate([
                        'value' => $inspection->sideSlipInspection->value,
                    ]);

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;

                /*
                |--------------------------------------------------------------------------
                | Suspension Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::SuspensionInspection:

                    if (! $inspection->suspensionInspection) {
                        break;
                    }

                    $result = app(SuspensionInspectionCalculator::class)->calculate([
                        'front_left' => $inspection->suspensionInspection->front_left,
                        'front_right' => $inspection->suspensionInspection->front_right,
                        'rear_left' => $inspection->suspensionInspection->rear_left,
                        'rear_right' => $inspection->suspensionInspection->rear_right,
                    ]);

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;

                /*
                |--------------------------------------------------------------------------
                | Visual Inspection
                |--------------------------------------------------------------------------
                */

                case InspectionModule::VisualInspection:

                    if (! $inspection->visualInspection) {
                        break;
                    }

                    $items = [];

                    foreach ($inspection->visualInspection->visualItemResults as $item) {

                        $items[$item->visual_item_id] = [
                            'result' => $item->result,
                        ];
                    }

                    $result = app(VisualInspectionCalculator::class)
                        ->calculate($items);

                    $this->collectFailures(
                        $module,
                        $result,
                        $failedModules,
                        $failedItems,
                    );

                    break;
            }
        }

        return [
            'result' => empty($failedModules)
                ? InspectionResult::Pass
                : InspectionResult::Fail,

            'failedModules' => $failedModules,

            'failedItems' => $failedItems,
        ];
    }

    private function requiredModules(Inspection $inspection): array
    {
        return config(
            "inspection-modules.{$inspection->inspectionType->code}",
            [],
        );
    }

    private function collectFailures(
        InspectionModule $module,
        array $result,
        array &$failedModules,
        array &$failedItems,
    ): void {

        if ($result['result'] !== InspectionResult::Fail) {
            return;
        }

        $failedModules[] = $module;

        $failedItems = array_merge(
            $failedItems,
            $result['failedItems'],
        );
    }
}
