<?php

namespace App\Services\Reports;

use App\Models\Inspection;

class ImportedVehicleReportService
{
    public function build(Inspection $inspection): array
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
        ]);

        return [
            'customer' => $inspection->customer,
            'vehicle' => $inspection->vehicleInformation,
            'visual' => $inspection->visualInspection,
            'brake' => $inspection->brakeInspection,
            'headlight' => $inspection->headLightInspection,
            'sideslip' => $inspection->sideSlipInspection,
            'suspension' => $inspection->suspensionInspection,
            'emission' => $inspection->emissionInspection,
        ];
    }
}
