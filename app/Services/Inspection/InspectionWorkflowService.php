<?php

namespace App\Services\Inspection;

use App\Enums\InspectionModule;
use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;

class InspectionWorkflowService
{
    public function __construct(
        private InspectionRequiredModulesService $requiredModules,
        private InspectionEvaluationService $evaluationService,
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
            'photos',
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
            'final_result' => InspectionResult::Pending,
        ]);
    }

    private function completeInspection(Inspection $inspection): void
    {

        $evaluation = $this->evaluationService->evaluate($inspection);

        $inspection->update([
            'status' => InspectionStatus::PendingApproval,
            'final_result' => $evaluation['result'],
        ]);
    }

    private function allRequiredModulesCompleted(
        Inspection $inspection,
    ): bool {

        foreach ($this->requiredModules->modules($inspection) as $module) {

            if ($module === InspectionModule::Photos) {

                if ($inspection->photos->count() < 5) {
                    return false;
                }

                continue;
            }

            if (! $inspection->{$module->relation()}) {
                return false;
            }
        }

        return true;
    }
}
