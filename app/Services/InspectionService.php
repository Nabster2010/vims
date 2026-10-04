<?php

namespace App\Services;

use App\Models\Inspection;

class InspectionService
{
    public function create(array $data): Inspection
    {
        return Inspection::create($data);

    }
}
