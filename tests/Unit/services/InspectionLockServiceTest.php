<?php

use App\Enums\InspectionStatus;
use App\Models\Inspection;
use App\Services\Inspection\InspectionLockService;
use DomainException;

it('locks an unlocked inspection', function () {

    $inspection = Inspection::factory()->create([
        'is_locked' => false,
    ]);

    app(InspectionLockService::class)->lock($inspection);

    $inspection->refresh();

    expect($inspection->is_locked)->toBeTrue();
});

it('does nothing when inspection is already locked', function () {

    $inspection = Inspection::factory()->locked()->create();

    app(InspectionLockService::class)->lock($inspection);

    $inspection->refresh();

    expect($inspection->is_locked)->toBeTrue();
});

it('unlocks inspection', function () {

    $inspection = Inspection::factory()->create([
        'status' => InspectionStatus::Approved,
        'approved_by' => 1,
        'approved_at' => now(),
        'is_locked' => true,
    ]);

    app(InspectionLockService::class)->unlock($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::PendingApproval);

    expect($inspection->approved_by)
        ->toBeNull();

    expect($inspection->approved_at)
        ->toBeNull();

    expect($inspection->is_locked)
        ->toBeFalse();
});

it('ensure unlocked passes when inspection is unlocked', function () {

    $inspection = Inspection::factory()->create([
        'is_locked' => false,
    ]);

    app(InspectionLockService::class)
        ->ensureUnlocked($inspection);

    expect(true)->toBeTrue();
});

it('ensure unlocked throws exception when inspection is locked', function () {

    $inspection = Inspection::factory()->locked()->create();

    expect(fn() => app(InspectionLockService::class)
        ->ensureUnlocked($inspection))
        ->toThrow(
            DomainException::class,
            'This inspection has already been approved and is locked.'
        );
});
