<?php

use App\Enums\InspectionResult;
use App\Models\VisualItem;
use App\Services\VisualInspectionCalculator;

it('returns null when no items are provided', function () {
    $result = app(VisualInspectionCalculator::class)->calculate([]);

    expect($result['result'])->toBeNull()
        ->and($result['failedItems'])->toBe([]);
});

it('returns null when all results are blank', function () {
    $item = VisualItem::create([
        'name' => 'Brakes',
        'code' => 'BRK',
    ]);

    $result = app(VisualInspectionCalculator::class)->calculate([
        $item->id => [
            'result' => null,
        ],
    ]);

    expect($result['result'])->toBeNull()
        ->and($result['failedItems'])->toBe([]);
});

it('passes when all items pass', function () {
    $item = VisualItem::create([
        'name' => 'Brakes',
        'code' => 'BRK',
    ]);

    $result = app(VisualInspectionCalculator::class)->calculate([
        $item->id => [
            'result' => InspectionResult::Pass,
        ],
    ]);

    expect($result['result'])->toBe(InspectionResult::Pass)
        ->and($result['failedItems'])->toBe([]);
});

it('fails when one item fails', function () {
    $item = VisualItem::create([
        'name' => 'Brakes',
        'code' => 'BRK',
    ]);

    $result = app(VisualInspectionCalculator::class)->calculate([
        $item->id => [
            'result' => InspectionResult::Fail,
        ],
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Brakes');
});

it('collects all failed items', function () {
    $item1 = VisualItem::create([
        'name' => 'Brakes',
        'code' => 'BRK',
    ]);

    $item2 = VisualItem::create([
        'name' => 'Lights',
        'code' => 'LGT',
    ]);

    $result = app(VisualInspectionCalculator::class)->calculate([
        $item1->id => [
            'result' => InspectionResult::Fail,
        ],
        $item2->id => [
            'result' => InspectionResult::Fail,
        ],
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Brakes')
        ->and($result['failedItems'])->toContain('Lights');
});

it('accepts enum values and enum instances', function () {
    $item1 = VisualItem::create([
        'name' => 'Brakes',
        'code' => 'BRK',
    ]);

    $item2 = VisualItem::create([
        'name' => 'Lights',
        'code' => 'LGT',
    ]);

    $result = app(VisualInspectionCalculator::class)->calculate([
        $item1->id => [
            'result' => InspectionResult::Pass->value,
        ],
        $item2->id => [
            'result' => InspectionResult::Fail,
        ],
    ]);

    expect($result['result'])->toBe(InspectionResult::Fail)
        ->and($result['failedItems'])->toContain('Lights');
});
