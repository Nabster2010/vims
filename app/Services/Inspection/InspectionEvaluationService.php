<?php

namespace App\Services\Inspection;

use App\Enums\CustomerType;
use App\Enums\InspectionModule;
use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\BrakeInspectionCalculator;
use App\Services\EmissionInspectionCalculator;
use App\Services\HeadLightInspectionCalculator;
use App\Services\SideSlipInspectionCalculator;
use App\Services\SuspensionInspectionCalculator;
use App\Services\VehicleInformationComplianceCalculator;
use App\Services\VisualInspectionCalculator;

class InspectionEvaluationService
{

    public function __construct(
        private InspectionRequiredModulesService $requiredModules,
        private BrakeInspectionCalculator $brakeCalculator,
        private EmissionInspectionCalculator $emissionCalculator,
        private HeadLightInspectionCalculator $headLightCalculator,
        private SideSlipInspectionCalculator $sideSlipCalculator,
        private SuspensionInspectionCalculator $suspensionCalculator,
        private VehicleInformationComplianceCalculator $vehicleCalculator,
        private VisualInspectionCalculator $visualCalculator,
    ) {}

    public function evaluate(Inspection $inspection): array
    {


        $inspection->load([
            'inspectionType',
            'vehicleInformation',
            'emissionInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'brakeInspection',
            'visualInspection.visualItemResults.visualItem',
            'photos',
            'customer',
        ]);

        $modules = [];
        $failedModules = [];
        $failedItems = [];
        $pendingModules = [];

        foreach ($this->requiredModules->modules($inspection) as $module) {

            $evaluation = $this->evaluateModule($inspection, $module);

            if ($evaluation['result'] === InspectionResult::Fail) {
                $failedModules[] = $module;

                $failedItems = array_merge(
                    $failedItems,
                    $evaluation['failedItems']
                );
            }

            if ($evaluation['result'] === InspectionResult::Pending) {
                $pendingModules[] = $module;
            }

            $modules[$module->value] = [
                'module' => $module,
                'route' => route($module->route(), $inspection),

                'status' => request()->routeIs($module->route())
                    ? 'current'
                    : ($evaluation['result'] === InspectionResult::Pending
                        ? 'pending'
                        : 'completed'),

                'result' => $evaluation['result'],

                'failedItems' => $evaluation['failedItems'],
            ];
        }

        return [

            'result' => ! empty($pendingModules)
                ? InspectionResult::Pending
                : (! empty($failedModules)
                    ? InspectionResult::Fail
                    : InspectionResult::Pass),

            'modules' => $modules,

            'failedModules' => $failedModules,

            'failedItems' => $failedItems,

            'pendingModules' => $pendingModules,

            'isCompleted' => empty($pendingModules),
        ];
    }

    private function evaluateModule(
        Inspection $inspection,
        InspectionModule $module,
    ): array {

        return match ($module) {

            /*
            |--------------------------------------------------------------------------
            | Vehicle Information
            |--------------------------------------------------------------------------
            */

            InspectionModule::VehicleInformation => ! $inspection->vehicleInformation
                ? [
                    'result' => InspectionResult::Pending,
                    'failedItems' => [],
                ]
                : $this->vehicleCalculator->calculate($inspection),

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
                : $this->brakeCalculator->calculate([
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
                : $this->emissionCalculator->calculate(
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
                : $this->headLightCalculator->calculate([
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
                :   $this->sideSlipCalculator->calculate([
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
                : $this->suspensionCalculator->calculate([
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
                        if ($item->visualItem->code === 'FUEL-ECONOMY-STANDARD' && $inspection->customer->customer_type->value === CustomerType::INDIVIDUAL->value) {
                            //skip this item for individual customers
                            continue;
                        }


                        $items[$item->visual_item_id] = [
                            'result' => $item->result,
                        ];
                    }

                    return $this->visualCalculator->calculate($items);
                })(),

            /*
            |--------------------------------------------------------------------------
            | Photos
            |--------------------------------------------------------------------------
            */

            InspectionModule::Photos => [
                'result' => $inspection->photos->count() >= 5
                    ? InspectionResult::Pass
                    : InspectionResult::Pending,

                'failedItems' => [],
            ],
        };
    }
}
