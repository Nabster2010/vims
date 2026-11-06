<?php

namespace App\Services\Inspection;

use App\Models\Inspection;

class InspectionRequiredModulesService
{
    public function modules(Inspection $inspection): array
    {
        $inspection->loadMissing('inspectionType');


        return config(
            "inspection-modules.{$inspection->inspectionType->code}",
            [],
        );
    }
}
