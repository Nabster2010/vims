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
        $inspection->load([
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
        $hasPendingModules = false;

        foreach ($requiredModules as $module) {
            if ($module === InspectionModule::VehicleInformation) {
                continue;
            }

            $result = $this->calculateModule(
                $inspection,
                $module,
            );

            if ($result['result'] === InspectionResult::Pending) {
                $hasPendingModules = true;
            }

            $this->collectFailures(
                $module,
                $result,
                $failedModules,
                $failedItems,
            );
        }

        $finalResult = InspectionResult::Pass;

        if ($hasPendingModules) {
            $finalResult = InspectionResult::Pending;
        } elseif (! empty($failedModules)) {
            $finalResult = InspectionResult::Fail;
        }

        return [
            'result' => $finalResult,

            'failedModules' => $failedModules,

            'failedItems' => $failedItems,
        ];
    }

    public function calculateModule(
        Inspection $inspection,
        InspectionModule $module,
    ): array {

        return match ($module) {

            /*
            |--------------------------------------------------------------------------
            | Vehicle Information
            |--------------------------------------------------------------------------
            */

            // InspectionModule::VehicleInformation => [
            //     'result' => InspectionResult::Pending,
            //     'failedItems' => [],
            // ],

            /*
            |--------------------------------------------------------------------------
            | Brake Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::BrakeInspection => ! $inspection->brakeInspection
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : app(BrakeInspectionCalculator::class)->calculate([
                    'front' => $inspection->brakeInspection->front,
                    'rear' => $inspection->brakeInspection->rear,
                    'parking' => $inspection->brakeInspection->parking,
                ]),

            /*
            |--------------------------------------------------------------------------
            | Emission Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::EmissionInspection => (
                ! $inspection->vehicleInformation ||
                ! $inspection->emissionInspection
            )
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : app(EmissionInspectionCalculator::class)->calculate(
                    $inspection->vehicleInformation->fuel_type,
                    [
                        'hc' => $inspection->emissionInspection->hc,
                        'co' => $inspection->emissionInspection->co,
                        'lambda' => $inspection->emissionInspection->lambda,
                        'opacity' => $inspection->emissionInspection->opacity,
                    ]
                ),

            /*
            |--------------------------------------------------------------------------
            | Head Light Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::HeadLightInspection => ! $inspection->headLightInspection
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : app(HeadLightInspectionCalculator::class)->calculate([
                    'left' => $inspection->headLightInspection->left,
                    'right' => $inspection->headLightInspection->right,
                ]),

            /*
            |--------------------------------------------------------------------------
            | Side Slip Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::SideSlipInspection => ! $inspection->sideSlipInspection
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : app(SideSlipInspectionCalculator::class)->calculate([
                    'value' => $inspection->sideSlipInspection->value,
                ]),

            /*
            |--------------------------------------------------------------------------
            | Suspension Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::SuspensionInspection => ! $inspection->suspensionInspection
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : app(SuspensionInspectionCalculator::class)->calculate([
                    'front_left' => $inspection->suspensionInspection->front_left,
                    'front_right' => $inspection->suspensionInspection->front_right,
                    'rear_left' => $inspection->suspensionInspection->rear_left,
                    'rear_right' => $inspection->suspensionInspection->rear_right,
                ]),

            /*
            |--------------------------------------------------------------------------
            | Visual Inspection
            |--------------------------------------------------------------------------
            */

            InspectionModule::VisualInspection => ! $inspection->visualInspection
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : (function () use ($inspection) {

                    $items = [];

                    foreach ($inspection->visualInspection->visualItemResults as $item) {
                        $items[$item->visual_item_id] = [
                            'result' => $item->result,
                        ];
                    }

                    return app(VisualInspectionCalculator::class)
                        ->calculate($items);
                })(),
        };
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
