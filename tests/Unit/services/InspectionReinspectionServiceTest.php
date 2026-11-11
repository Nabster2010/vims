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
use App\Services\Inspection\InspectionReinspectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a reinspection successfully', function () {
    $inspection = Inspection::factory()->create([
        'status' => InspectionStatus::Approved,
        'final_result' => InspectionResult::Fail,
        'reinspection_count' => 0,
        'approved_by' => 1,
        'approved_at' => now(),
        'is_locked' => true,
    ]);

    VehicleInformation::factory()->create([
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

    BrakeInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    VisualInspection::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    $service = app(InspectionReinspectionService::class);

    $service->create($inspection);

    $inspection->refresh();

    expect($inspection->reinspection_count)->toBe(1)
        ->and($inspection->status)->toBe(InspectionStatus::Reinspection)
        ->and($inspection->final_result)->toBe(InspectionResult::Pending)
        ->and($inspection->approved_by)->toBeNull()
        ->and($inspection->approved_at)->toBeNull()
        ->and($inspection->is_locked)->toBeFalse();

    expect(VehicleInformation::count())->toBe(0);
    expect(EmissionInspection::count())->toBe(0);
    expect(HeadLightInspection::count())->toBe(0);
    expect(SideSlipInspection::count())->toBe(0);
    expect(SuspensionInspection::count())->toBe(0);
    expect(BrakeInspection::count())->toBe(0);
    expect(VisualInspection::count())->toBe(0);
});
