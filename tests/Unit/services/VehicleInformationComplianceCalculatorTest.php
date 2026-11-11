<?php

use App\Enums\ComplianceStatus;
use App\Enums\CustomerType;
use App\Enums\InspectionResult;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\VehicleInformation;
use App\Services\VehicleInformationComplianceCalculator;

it('passes when all compliance checks pass', function () {

    $inspection = Inspection::factory()->imported()->create();

    Customer::find($inspection->customer_id)->update([
        'customer_type' => CustomerType::COMPANY,
    ]);

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'vehicle_age_compliance' => ComplianceStatus::PASS,
        'fuel_economy_compliance' => ComplianceStatus::PASS,
    ]);

    $inspection->load('inspectionType', 'vehicleInformation', 'customer');

    $result = app(VehicleInformationComplianceCalculator::class)
        ->calculate($inspection);

    expect($result['result'])->toBe(InspectionResult::Pass);
    expect($result['failedItems'])->toBe([]);
});

it('fails when fuel economy compliance fails for company customer', function () {

    $inspection = Inspection::factory()->imported()->create();

    Customer::find($inspection->customer_id)->update([
        'customer_type' => CustomerType::COMPANY,
    ]);

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'vehicle_age_compliance' => ComplianceStatus::PASS,
        'fuel_economy_compliance' => ComplianceStatus::FAIL,
    ]);

    $inspection->load('inspectionType', 'vehicleInformation', 'customer');

    $result = app(VehicleInformationComplianceCalculator::class)
        ->calculate($inspection);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toBe(['fuel_economy_compliance']);
});

it('ignores fuel economy compliance for individual customer', function () {

    $inspection = Inspection::factory()->imported()->create();

    Customer::find($inspection->customer_id)->update([
        'customer_type' => CustomerType::INDIVIDUAL,
    ]);

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'vehicle_age_compliance' => ComplianceStatus::PASS,
        'fuel_economy_compliance' => ComplianceStatus::FAIL,
    ]);

    $inspection->load('inspectionType', 'vehicleInformation', 'customer');

    $result = app(VehicleInformationComplianceCalculator::class)
        ->calculate($inspection);

    expect($result['result'])->toBe(InspectionResult::Pass);

    expect($result['failedItems'])->toBe([]);
});

it('ignores vehicle age compliance failure', function () {

    $inspection = Inspection::factory()->imported()->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'vehicle_age_compliance' => ComplianceStatus::FAIL,
        'fuel_economy_compliance' => ComplianceStatus::PASS,
    ]);

    $inspection->load('inspectionType', 'vehicleInformation', 'customer');

    $result = app(VehicleInformationComplianceCalculator::class)
        ->calculate($inspection);

    expect($result['result'])->toBe(InspectionResult::Pass);

    expect($result['failedItems'])->toBe([]);
});

it('fails for saber inspection when required checks fail', function () {

    $inspection = Inspection::factory()->saber()->create();

    VehicleInformation::factory()->create([
        'inspection_id' => $inspection->id,
        'energy_efficiency_compliance' => ComplianceStatus::FAIL,
        'fuel_economy_compliance' => ComplianceStatus::PASS,
        'vehicle_age_compliance' => ComplianceStatus::PASS,
        'is_vehicle_rare' => ComplianceStatus::PASS,
    ]);

    $inspection->load('inspectionType', 'vehicleInformation', 'customer');

    $result = app(VehicleInformationComplianceCalculator::class)
        ->calculate($inspection);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toBe(['energy_efficiency_compliance']);
});
