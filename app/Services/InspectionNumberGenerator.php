<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Inspection;
use App\Models\InspectionType;

class InspectionNumberGenerator
{
    public function generate(
        Branch $branch,
        InspectionType $inspectionType
    ): string {
        $branch->increment('last_inspection_sequence');
        $branch->refresh();
        $sequence = str_pad(
            $branch->last_inspection_sequence,
            6,
            '0',
            STR_PAD_LEFT
        );

        return sprintf(

            '%s-%s-%s-%s',

            $branch->code,

            $inspectionType->code,

            now()->year,

            $sequence,

        );
    }

    public function regenerate(Inspection $inspection, string $newCode): string
    {
        $parts = explode('-', $inspection->inspection_no);

        return sprintf(
            '%s-%s-%s-%s',
            $parts[0],
            $newCode,
            $parts[2],
            $parts[3],
        );
    }
}
