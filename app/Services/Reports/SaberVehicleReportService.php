<?php

namespace App\Services\Reports;

use App\Models\Inspection;

class SaberVehicleReportService
{
    public function build(Inspection $inspection): Inspection
    {
        $inspection->loadMissing([
            'branch',
            'customer',
            'inspectionType',
            'vehicleInformation',
            'visualInspection.visualItemResults',
            'brakeInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'emissionInspection',
            'photos'
        ]);

        return $inspection;
    }
}
