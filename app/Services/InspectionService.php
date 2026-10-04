<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Enums\InspectionStatus;
use Illuminate\Support\Str;

class InspectionService
{
    public function __construct(
        protected InspectionNumberGenerator $numberGenerator
    ) {}

    public function create(array $data): Inspection
    {
        $data['uuid'] = (string) Str::uuid();
        $data['inspection_no'] = $this->numberGenerator->generate();
        $data['status'] = InspectionStatus::Registered;
        $data['registered_at'] = now();
        return Inspection::create($data);
    }
    // private function generateInspectionNumber(
    //     Branch $branch,
    //     InspectionType $inspectionType
    // ): string {
    //     $branch->increment('last_inspection_sequence');

    //     $sequence = str_pad(
    //         $branch->last_inspection_sequence,
    //         6,
    //         '0',
    //         STR_PAD_LEFT
    //     );

    //     return "{$branch->code}-{$inspectionType->code}-{$sequence}";
    // }
}
