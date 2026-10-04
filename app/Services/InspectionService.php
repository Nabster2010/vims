<?php

namespace App\Services;

use App\Models\Inspection;
use Illuminate\Support\Str;

class InspectionService
{
    public function create(array $data): Inspection
    {
        $data['uuid'] = Str::uuid();
        return Inspection::create($data);
    }
}
