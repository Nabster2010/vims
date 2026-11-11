<?php

use App\Enums\FuelType;
use App\Enums\InspectionResult;
use App\Services\EmissionInspectionCalculator;

it('passes gasoline emission when values are within limits', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Gasoline,
        [
            'hc' => 500,
            'co' => 2.0,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Pass)
        ->and($result['failedItems'])->toBe([]);
});

it('fails when hc exceeds limit', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Gasoline,
        [
            'hc' => 1500,
            'co' => 2.0,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Emission Hydrocarbons');
});

it('fails when co exceeds limit', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Gasoline,
        [
            'hc' => 500,
            'co' => 5,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Emission Carbon Monoxide');
});

it('returns multiple failed items', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Gasoline,
        [
            'hc' => 1500,
            'co' => 5,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Emission Hydrocarbons')
        ->toContain('Emission Carbon Monoxide');
});

it('passes diesel opacity inspection', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Diesel,
        [
            'opacity' => 25,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Pass)
        ->and($result['failedItems'])->toBe([]);
});

it('fails diesel opacity inspection', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Diesel,
        [
            'opacity' => 55,
        ]
    );

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Diesel Opacity');
});

it('returns pending when no values are entered', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Gasoline,
        []
    );

    expect($result['result'])->toBe(InspectionResult::Pending)
        ->and($result['failedItems'])->toBe([]);
});

it('returns null for electric vehicles', function () {

    $result = app(EmissionInspectionCalculator::class)->calculate(
        FuelType::Ev,
        []
    );

    expect($result['result'])->toBeNull()
        ->and($result['failedItems'])->toBe([]);
});
