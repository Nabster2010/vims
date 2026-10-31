<?php

namespace App\Services\Reports;

use App\Models\Inspection;

class TrailerReportService
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
            'photos'
        ]);



        return $inspection;
    }
}
