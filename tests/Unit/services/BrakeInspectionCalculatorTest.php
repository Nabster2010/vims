<?php

use App\Enums\InspectionResult;
use App\Services\BrakeInspectionCalculator;

it('passes when all brake values are within limits', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 60,
        'rear' => 55,
        'parking' => 30,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass)
        ->and($result['failedItems'])->toBe([]);
});

it('fails when front brake is below minimum', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 25,
        'rear' => 55,
        'parking' => 30,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Brake Front');
});

it('fails when rear brake is below minimum', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 60,
        'rear' => 20,
        'parking' => 30,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Brake Rear');
});

it('fails when parking brake is below minimum', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 60,
        'rear' => 55,
        'parking' => 15,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Brake Parking');
});

it('returns all failed brake items', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 25,
        'rear' => 20,
        'parking' => 15,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Brake Front')
        ->toContain('Brake Rear')
        ->toContain('Brake Parking');
});

it('returns pending when no values are entered', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([]);

    expect($result['result'])->toBe(InspectionResult::Pending)
        ->and($result['failedItems'])->toBe([]);
});

it('accepts values exactly on minimum limits', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 30,
        'rear' => 30,
        'parking' => 20,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});

it('accepts values exactly on maximum limits', function () {

    $result = app(BrakeInspectionCalculator::class)->calculate([
        'front' => 100,
        'rear' => 100,
        'parking' => 100,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});
