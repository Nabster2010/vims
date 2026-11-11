<?php

use App\Enums\InspectionResult;
use App\Services\SuspensionInspectionCalculator;

it('returns pending when no values are entered', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => null,
        'front_right' => null,
        'rear_left' => null,
        'rear_right' => null,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pending);
    expect($result['failedItems'])->toBe([]);
});

it('passes when all suspension values are within limits', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 60,
        'front_right' => 65,
        'rear_left' => 50,
        'rear_right' => 55,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
    expect($result['failedItems'])->toBe([]);
});

it('fails when front left is below minimum', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 20,
        'front_right' => 65,
        'rear_left' => 50,
        'rear_right' => 55,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Suspension Front Left');
});

it('fails when front right is below minimum', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 60,
        'front_right' => 25,
        'rear_left' => 50,
        'rear_right' => 55,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Suspension Front Right');
});

it('fails when rear left is below minimum', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 60,
        'front_right' => 65,
        'rear_left' => 10,
        'rear_right' => 55,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Suspension Rear Left');
});

it('fails when rear right is below minimum', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 60,
        'front_right' => 65,
        'rear_left' => 50,
        'rear_right' => 10,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Suspension Rear Right');
});

it('returns all failed suspension items', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 20,
        'front_right' => 25,
        'rear_left' => 10,
        'rear_right' => 15,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Suspension Front Left')
        ->toContain('Suspension Front Right')
        ->toContain('Suspension Rear Left')
        ->toContain('Suspension Rear Right')
        ->toHaveCount(4);
});

it('passes on all minimum boundaries', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 30,
        'front_right' => 30,
        'rear_left' => 20,
        'rear_right' => 20,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});

it('passes on all maximum boundaries', function () {

    $result = app(SuspensionInspectionCalculator::class)->calculate([
        'front_left' => 100,
        'front_right' => 100,
        'rear_left' => 100,
        'rear_right' => 100,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});
