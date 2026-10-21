<?php

namespace App\Services\Inspection;

use App\Enums\InspectionModule;
use App\Enums\InspectionStatus;
use App\Models\Inspection;

class InspectionWorkflowService
{
    public function __construct(
        private InspectionRequiredModulesService $requiredModules,
        private InspectionFinalResultService $finalResult,
    ) {}

    public function sync(Inspection $inspection): void
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

        if (! $this->allRequiredModulesCompleted($inspection)) {
            $this->markInProgress($inspection);

            return;
        }

        $this->completeInspection($inspection);
    }

    private function markInProgress(Inspection $inspection): void
    {
        if ($inspection->status === InspectionStatus::InProgress) {
            return;
        }

        $inspection->update([
            'status' => InspectionStatus::InProgress,
        ]);
    }

    private function completeInspection(Inspection $inspection): void
    {
        // if (
        //     $inspection->status === InspectionStatus::PendingApproval ||
        //     $inspection->status === InspectionStatus::Approved
        // ) {
        //     return;
        // }

        $result = $this->finalResult->calculate($inspection);

        $inspection->update([
            'status' => InspectionStatus::PendingApproval,
            'final_result' => $result['result'],
        ]);
    }

    private function allRequiredModulesCompleted(
        Inspection $inspection,
    ): bool {

        foreach ($this->requiredModules->modules($inspection) as $module) {

            if (! $inspection->{$module->relation()}) {
                return false;
            }
        }

        return true;
    }
}
