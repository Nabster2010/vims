<?php

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\BrakeInspection;
use App\Models\EmissionInspection;
use App\Models\HeadLightInspection;
use App\Models\Inspection;
use App\Models\SideSlipInspection;
use App\Models\SuspensionInspection;
use App\Models\VehicleInformation;
use App\Models\VisualInspection;
use App\Services\Inspection\InspectionResetService;

it('resets inspection and deletes all inspection modules', function () {

    $inspection = Inspection::factory()
        ->approved()
        ->failed()
        ->locked()
        ->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    BrakeInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    EmissionInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    HeadLightInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    SideSlipInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    SuspensionInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    VisualInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    app(InspectionResetService::class)
        ->reset($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::Registered);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pending);

    expect($inspection->approved_by)
        ->toBeNull();

    expect($inspection->approved_at)
        ->toBeNull();

    expect($inspection->is_locked)
        ->toBeFalse();

    expect(VehicleInformation::count())->toBe(0);
    expect(BrakeInspection::count())->toBe(0);
    expect(EmissionInspection::count())->toBe(0);
    expect(HeadLightInspection::count())->toBe(0);
    expect(SideSlipInspection::count())->toBe(0);
    expect(SuspensionInspection::count())->toBe(0);
    expect(VisualInspection::count())->toBe(0);
});

it('can reset inspection even when no modules exist', function () {

    $inspection = Inspection::factory()
        ->approved()
        ->passed()
        ->locked()
        ->create();

    app(InspectionResetService::class)
        ->reset($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::Registered);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pending);

    expect($inspection->approved_by)
        ->toBeNull();

    expect($inspection->approved_at)
        ->toBeNull();

    expect($inspection->is_locked)
        ->toBeFalse();
});
