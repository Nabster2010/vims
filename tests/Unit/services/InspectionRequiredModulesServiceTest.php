<?php

use App\Enums\FuelType;
use App\Enums\InspectionModule;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\VehicleInformation;
use App\Services\Inspection\InspectionRequiredModulesService;

it('returns configured modules for inspection type', function () {

    config()->set('inspection-modules.IMP', [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::Photos,
    ]);

    $inspection = Inspection::factory()->create([
        'inspection_type_id' => InspectionType::factory()->imported(),
    ]);

    $modules = app(InspectionRequiredModulesService::class)
        ->modules($inspection);

    expect($modules)->toBe([
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::Photos,
    ]);
});

it('removes emission module for electric vehicles', function () {

    config()->set('inspection-modules.IMP', [
        InspectionModule::VehicleInformation,
        InspectionModule::EmissionInspection,
        InspectionModule::Photos,
    ]);

    $inspection = Inspection::factory()->imported()->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'fuel_type' => FuelType::Ev,
    ]);

    $modules = app(InspectionRequiredModulesService::class)
        ->modules($inspection);

    expect($modules)
        ->not->toContain(InspectionModule::EmissionInspection)
        ->toContain(InspectionModule::VehicleInformation)
        ->toContain(InspectionModule::Photos);
});

it('returns empty array when inspection type has no configured modules', function () {

    $inspection = Inspection::factory()->create([
        'inspection_type_id' => InspectionType::factory()->imported(),
    ]);

    config()->set('inspection-modules.IMP', []);

    $modules = app(InspectionRequiredModulesService::class)
        ->modules($inspection);

    expect($modules)->toBe([]);
});
