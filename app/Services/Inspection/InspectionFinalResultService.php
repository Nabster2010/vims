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

        $requiredModules = app(
            InspectionRequiredModulesService::class
        )->modules($inspection);

        $failedModules = [];
        $failedItems = [];

        foreach ($requiredModules as $module) {

            $result = $this->calculateModule(
                $inspection,
                $module,
            );

            $this->collectFailures(
                $module,
                $result,
                $failedModules,
                $failedItems,
            );
        }

        return [
            'result' => empty($failedModules)
                ? InspectionResult::Pass
                : InspectionResult::Fail,

            'failedModules' => $failedModules,

            'failedItems' => $failedItems,
        ];
    }

    public function calculateModule(
        Inspection $inspection,
        InspectionModule $module,
    ): array {

        switch ($module) {

            /*
            |--------------------------------------------------------------------------
            | Brake Inspection
            |--------------------------------------------------------------------------
            */

            case InspectionModule::BrakeInspection:

                if (! $inspection->brakeInspection) {
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                return app(BrakeInspectionCalculator::class)->calculate([
                    'front' => $inspection->brakeInspection->front,
                    'rear' => $inspection->brakeInspection->rear,
                    'parking' => $inspection->brakeInspection->parking,
                ]);

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
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                return app(EmissionInspectionCalculator::class)->calculate(
                    $inspection->vehicleInformation->fuel_type,
                    [
                        'hc' => $inspection->emissionInspection->hc,
                        'co' => $inspection->emissionInspection->co,
                        'lambda' => $inspection->emissionInspection->lambda,
                        'opacity' => $inspection->emissionInspection->opacity,
                    ]
                );

                /*
            |--------------------------------------------------------------------------
            | Head Light Inspection
            |--------------------------------------------------------------------------
            */

            case InspectionModule::HeadLightInspection:

                if (! $inspection->headLightInspection) {
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                return app(HeadLightInspectionCalculator::class)->calculate([
                    'left' => $inspection->headLightInspection->left,
                    'right' => $inspection->headLightInspection->right,
                ]);

                /*
            |--------------------------------------------------------------------------
            | Side Slip Inspection
            |--------------------------------------------------------------------------
            */

            case InspectionModule::SideSlipInspection:

                if (! $inspection->sideSlipInspection) {
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                return app(SideSlipInspectionCalculator::class)->calculate([
                    'value' => $inspection->sideSlipInspection->value,
                ]);

                /*
            |--------------------------------------------------------------------------
            | Suspension Inspection
            |--------------------------------------------------------------------------
            */

            case InspectionModule::SuspensionInspection:

                if (! $inspection->suspensionInspection) {
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                return app(SuspensionInspectionCalculator::class)->calculate([
                    'front_left' => $inspection->suspensionInspection->front_left,
                    'front_right' => $inspection->suspensionInspection->front_right,
                    'rear_left' => $inspection->suspensionInspection->rear_left,
                    'rear_right' => $inspection->suspensionInspection->rear_right,
                ]);

                /*
            |--------------------------------------------------------------------------
            | Visual Inspection
            |--------------------------------------------------------------------------
            */

            case InspectionModule::VisualInspection:

                if (! $inspection->visualInspection) {
                    return [
                        'result' => InspectionResult::Pending,
                        'failedItems' => [],
                    ];
                }

                $items = [];

                foreach ($inspection->visualInspection->visualItemResults as $item) {

                    $items[$item->visual_item_id] = [
                        'result' => $item->result,
                    ];
                }

                return app(VisualInspectionCalculator::class)
                    ->calculate($items);
            default:

                return [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ];
        }
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
