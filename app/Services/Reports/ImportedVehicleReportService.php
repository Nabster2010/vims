<?php

namespace App\Services\Reports;

use App\Models\Branch;
use App\Models\Inspection;

class ImportedVehicleReportService
{
    public function build(Inspection $inspection): Inspection
    {
        $inspection =  $inspection->loadMissing([
            'branch.manager',
            'customer',
            'customPort',
            'inspectionType',
            'vehicleInformation',
            'visualInspection.visualItemResults',
            'brakeInspection',
            'headLightInspection',
            'sideSlipInspection',
            'suspensionInspection',
            'emissionInspection',
        ]);



        return $inspection;
    }
}
