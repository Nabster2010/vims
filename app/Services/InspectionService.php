<?php

namespace App\Services;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Branch;
use App\Models\Inspection;
use App\Models\InspectionType;
use Illuminate\Support\Str;

class InspectionService
{
    public function __construct(
        protected InspectionNumberGenerator $numberGenerator
    ) {}

    public function create(array $data): Inspection
    {
        $branch = Branch::findOrFail($data['branch_id']);
        $inspectionType = InspectionType::findOrFail($data['inspection_type_id']);
        $data['uuid'] = (string) Str::uuid();
        $data['inspection_no'] = $this->numberGenerator->generate($branch, $inspectionType);
        $data['status'] = InspectionStatus::Registered;
        $data['registered_at'] = now();
        $data['final_result'] = InspectionResult::Pending;
        return Inspection::create($data);
    }

    public function update(Inspection $inspection, array $data): Inspection
    {
        if ($inspection->inspection_type_id !== (int) $data['inspection_type_id']) {

            $code = InspectionType::findOrFail(
                $data['inspection_type_id']
            )->code;

            $data['inspection_no'] = $this->numberGenerator
                ->regenerate($inspection, $code);
        }
        $inspection->update($data);
        return $inspection->fresh();
    }
}
