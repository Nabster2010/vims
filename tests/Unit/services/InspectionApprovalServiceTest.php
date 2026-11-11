<?php

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;
use App\Models\User;
use App\Services\Inspection\InspectionApprovalService;
use DomainException;

it('approves inspection successfully', function () {

    $user = User::factory()->create();

    $inspection = Inspection::factory()->create([
        'status' => InspectionStatus::PendingApproval,
        'final_result' => InspectionResult::Pass,
        'is_locked' => false,
        'approved_by' => null,
        'approved_at' => null,
    ]);

    app(InspectionApprovalService::class)
        ->approve($inspection, $user);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::Approved);

    expect($inspection->approved_by)
        ->toBe($user->id);

    expect($inspection->approved_at)
        ->not->toBeNull();

    expect($inspection->is_locked)
        ->toBeTrue();
});

it('throws exception when inspection is not pending approval', function () {

    $user = User::factory()->create();

    $inspection = Inspection::factory()->create([
        'status' => InspectionStatus::InProgress,
        'final_result' => InspectionResult::Pass,
    ]);

    expect(fn () => app(InspectionApprovalService::class)
        ->approve($inspection, $user))
        ->toThrow(
            DomainException::class,
            'Inspection is not ready for approval.'
        );

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::InProgress);

    expect($inspection->approved_by)
        ->toBeNull();

    expect($inspection->approved_at)
        ->toBeNull();
});

it('throws exception when inspection result is pending', function () {

    $user = User::factory()->create();

    $inspection = Inspection::factory()->create([
        'status' => InspectionStatus::PendingApproval,
        'final_result' => InspectionResult::Pending,
    ]);

    expect(fn () => app(InspectionApprovalService::class)
        ->approve($inspection, $user))
        ->toThrow(
            DomainException::class,
            'Inspection result is still pending.'
        );

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::PendingApproval);

    expect($inspection->approved_by)
        ->toBeNull();

    expect($inspection->approved_at)
        ->toBeNull();
});
