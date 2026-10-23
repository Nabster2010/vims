<?php

namespace App\Services\Inspection;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;
use DomainException;

class InspectionLockService
{
    public function lock(Inspection $inspection): void
    {
        if ($inspection->is_locked) {
            return;
        }

        $inspection->update([
            'is_locked' => true,
        ]);
    }

    public function unlock(Inspection $inspection): void
    {
        $inspection->update([
            'status' => InspectionStatus::Registered,
            'final_result' => InspectionResult::Pending,
            'approved_by' => null,
            'approved_at' => null,
            'is_locked' => false,
        ]);
    }

    public function ensureUnlocked(Inspection $inspection): void
    {
        if (! $inspection->is_locked) {
            return;
        }

        throw new DomainException(
            'This inspection has already been approved and is locked.'
        );
    }
}
