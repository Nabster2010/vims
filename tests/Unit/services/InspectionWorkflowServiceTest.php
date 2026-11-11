<?php

use App\Enums\InspectionModule;
use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Inspection;
use App\Models\VehicleInformation;
use App\Services\Inspection\InspectionEvaluationService;
use App\Services\Inspection\InspectionRequiredModulesService;
use App\Services\Inspection\InspectionWorkflowService;
use Mockery;

afterEach(function () {
    Mockery::close();
});

it('marks inspection as in progress when required modules are missing', function () {

    $inspection = Inspection::factory()->create();

    $requiredModules = Mockery::mock(InspectionRequiredModulesService::class);
    $evaluation = Mockery::mock(InspectionEvaluationService::class);

    $requiredModules
        ->shouldReceive('modules')
        ->once()
        ->andReturn([
            InspectionModule::VehicleInformation,
        ]);

    $service = new InspectionWorkflowService(
        $requiredModules,
        $evaluation,
    );

    $service->sync($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::InProgress);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pending);
});

it('does not update inspection already in progress', function () {

    $inspection = Inspection::factory()
        ->inProgress()
        ->create();

    $requiredModules = Mockery::mock(InspectionRequiredModulesService::class);
    $evaluation = Mockery::mock(InspectionEvaluationService::class);

    $requiredModules
        ->shouldReceive('modules')
        ->once()
        ->andReturn([
            InspectionModule::VehicleInformation,
        ]);

    $service = new InspectionWorkflowService(
        $requiredModules,
        $evaluation,
    );

    $service->sync($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::InProgress);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pending);
});

it('completes inspection when all required modules are completed', function () {

    $inspection = Inspection::factory()->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    $requiredModules = Mockery::mock(InspectionRequiredModulesService::class);
    $evaluation = Mockery::mock(InspectionEvaluationService::class);

    $requiredModules
        ->shouldReceive('modules')
        ->once()
        ->andReturn([
            InspectionModule::VehicleInformation,
        ]);

    $evaluation
        ->shouldReceive('evaluate')
        ->once()
        ->with($inspection)
        ->andReturn([
            'result' => InspectionResult::Pass,
        ]);

    $service = new InspectionWorkflowService(
        $requiredModules,
        $evaluation,
    );

    $service->sync($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::PendingApproval);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pass);
});

it('stores failed result returned by evaluation service', function () {

    $inspection = Inspection::factory()->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
    ]);

    $requiredModules = Mockery::mock(InspectionRequiredModulesService::class);
    $evaluation = Mockery::mock(InspectionEvaluationService::class);

    $requiredModules
        ->shouldReceive('modules')
        ->once()
        ->andReturn([
            InspectionModule::VehicleInformation,
        ]);

    $evaluation
        ->shouldReceive('evaluate')
        ->once()
        ->andReturn([
            'result' => InspectionResult::Fail,
        ]);

    $service = new InspectionWorkflowService(
        $requiredModules,
        $evaluation,
    );

    $service->sync($inspection);

    $inspection->refresh();

    expect($inspection->status)
        ->toBe(InspectionStatus::PendingApproval);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Fail);
});
