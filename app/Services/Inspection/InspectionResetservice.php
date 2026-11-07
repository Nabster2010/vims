<?php

namespace App\Services\Inspection;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;
use Illuminate\Support\Facades\DB;

class InspectionResetService
{
    public function reset(Inspection $inspection): void
    {
        DB::transaction(function () use ($inspection) {

            $inspection->vehicleInformation()->delete();
            $inspection->emissionInspection()->delete();
            $inspection->headLightInspection()->delete();
            $inspection->sideSlipInspection()->delete();
            $inspection->suspensionInspection()->delete();
            $inspection->brakeInspection()->delete();
            $inspection->visualInspection()->delete();
            $inspection->update([
                'status' => InspectionStatus::Registered,

                'final_result' => InspectionResult::Pending,

                'approved_by' => null,

                'approved_at' => null,

                'is_locked' => false,
            ]);
        });
    }
}
