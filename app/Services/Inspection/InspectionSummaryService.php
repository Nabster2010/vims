<?php

namespace App\Services\Inspection;

use App\Models\Inspection;

class InspectionSummaryService
{
    public function __construct(
        private InspectionFinalResultService $finalResult,
        private InspectionStepperService $stepper,
    ) {}

    public function summary(Inspection $inspection): array
    {
        return [
            'inspection' => $inspection,
            'steps' => $this->stepper->steps($inspection),
            'result' => $this->finalResult->calculate($inspection),
        ];
    }
}
