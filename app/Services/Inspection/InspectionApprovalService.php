<?php

namespace App\Services\Inspection;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;
use App\Models\User;
use App\Services\Inspection\InspectionLockService;
use DomainException;

class InspectionApprovalService
{
    public function approve(
        Inspection $inspection,
        User $user,
    ): void {

        if ($inspection->status !== InspectionStatus::PendingApproval) {
            throw new DomainException(
                'Inspection is not ready for approval.'
            );
        }

        if ($inspection->final_result === InspectionResult::Pending) {
            throw new DomainException(
                'Inspection result is still pending.'
            );
        }

        $inspection->update([
            'status' => InspectionStatus::Approved,
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);
        app(InspectionLockService::class)->lock($inspection);
    }
}
