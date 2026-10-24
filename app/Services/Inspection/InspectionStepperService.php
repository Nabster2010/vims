<?php

namespace App\Services\Inspection;

use App\Enums\InspectionStatus;
use App\Models\Inspection;

class InspectionStepperService
{
    public function __construct(
        private InspectionRequiredModulesService $requiredModules,
    ) {}

    public function steps(Inspection $inspection): array
    {
        $inspection->loadMissing([
            'inspectionType',
            'vehicleInformation',
            'emissionInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'brakeInspection',
            'visualInspection',
        ]);

        $steps = [];

        /*
        |--------------------------------------------------------------------------
        | Registration
        |--------------------------------------------------------------------------
        */

        // $steps[] = [
        //     'module' => null,
        //     'label' => 'Registration',
        //     'route' => route('inspections.edit', $inspection),
        //     'status' => $this->stepStatus(
        //         request()->routeIs('inspections.edit'),
        //         true,
        //     ),
        // ];

        /*
        |--------------------------------------------------------------------------
        | Inspection Modules
        |--------------------------------------------------------------------------
        */

        foreach ($this->requiredModules->modules($inspection) as $module) {

            $steps[] = [
                'module' => $module,
                'route' => route($module->route(), $inspection),
                'status' => $this->stepStatus(
                    request()->routeIs($module->route()),
                    $inspection->{$module->relation()} !== null,
                ),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        // $steps[] = [
        //     'module' => null,
        //     'label' => 'Summary',
        //     'route' => route('inspections.show', $inspection),
        //     'status' => $this->stepStatus(
        //         request()->routeIs('inspections.show'),
        //         in_array(
        //             $inspection->status,
        //             [
        //                 InspectionStatus::PendingApproval,
        //                 InspectionStatus::Approved,
        //             ],
        //             true,
        //         ),
        //     ),
        // ];

        return $steps;
    }

    private function stepStatus(
        bool $current,
        bool $completed,
    ): string {

        if ($current) {
            return 'current';
        }

        if ($completed) {
            return 'completed';
        }

        return 'pending';
    }
}
