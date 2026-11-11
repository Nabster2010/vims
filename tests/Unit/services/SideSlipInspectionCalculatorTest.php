<?php

use App\Enums\InspectionResult;
use App\Services\SideSlipInspectionCalculator;

it('returns pending when no value is entered', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => null,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pending);
    expect($result['failedItems'])->toBe([]);
});

it('passes when side slip is within limits', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => 5,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
    expect($result['failedItems'])->toBe([]);
});

it('fails when side slip exceeds maximum limit', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => 10,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Side Slip');
});

it('fails when side slip is below minimum limit', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => -1,
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail);

    expect($result['failedItems'])
        ->toContain('Side Slip');
});

it('passes on minimum boundary', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => 0,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});

it('passes on maximum boundary', function () {

    $result = app(SideSlipInspectionCalculator::class)->calculate([
        'value' => 7,
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass);
});
