<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\InspectionType;
use Illuminate\Support\Str;

class InspectionService
{
    public function create(array $data): Inspection
    {
        $data['uuid'] = Str::uuid();
        return Inspection::create($data);
    }
    private function generateInspectionNumber(Branch $branch,InspectionType $inspectionType
    ): string
    {


    }
}
