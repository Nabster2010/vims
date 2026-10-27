<?php

namespace App\Services\Inspection;

use App\Enums\InspectionStatus;
use App\Models\Inspection;
use Illuminate\Support\Facades\DB;

class InspectionReinspectionService
{
    public function create(Inspection $inspection): void
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
                'reinspection_count' => $inspection->reinspection_count + 1,

                'status' => InspectionStatus::Reinspection,

                'final_result' => null,

                'approved_by' => null,

                'approved_at' => null,

                'is_locked' => false,
            ]);
        });
    }
}
