<?php

use App\Enums\InspectionResult;
use App\Services\HeadLightInspectionCalculator;

it('returns pending when no values are entered', function () {

    $result = app(HeadLightInspectionCalculator::class)->calculate([
        'left' => null,
        'right' => null,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pending);
    expect($result['failedItems'])->toBe([]);
});

it('passes when both headlights are within limits', function () {

    $result = app(HeadLightInspectionCalculator::class)->calculate([
        'left' => 120,
        'right' => 180,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
    expect($result['failedItems'])->toBe([]);
});

it('fails when left headlight exceeds maximum', function () {

    $result = app(HeadLightInspectionCalculator::class)->calculate([
        'left' => 300,
        'right' => 180,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Head Light Left');
});

it('fails when right headlight exceeds maximum', function () {

    $result = app(HeadLightInspectionCalculator::class)->calculate([
        'left' => 180,
        'right' => 400,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Head Light Right');
});

it('returns all failed headlights', function () {

    $result = app(HeadLightInspectionCalculator::class)->calculate([
        'left' => 400,
        'right' => 500,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Head Light Left')
        ->toContain('Head Light Right')
        ->toHaveCount(2);
});
