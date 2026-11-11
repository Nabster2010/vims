<?php

use App\Models\Branch;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Services\InspectionNumberGenerator;

it('generates the first inspection number', function () {

    $branch = Branch::factory()->create([
        'code' => 'RUH',
        'last_inspection_sequence' => 0,
    ]);

    $type = InspectionType::factory()->imported()->create();

    $number = app(InspectionNumberGenerator::class)
        ->generate($branch, $type);

    expect($number)
        ->toBe('RUH-IMP-' . now()->year . '-000001');

    expect($branch->fresh()->last_inspection_sequence)
        ->toBe(1);
});
it('increments inspection sequence', function () {

    $branch = Branch::factory()->create([
        'code' => 'RUH',
        'last_inspection_sequence' => 25,
    ]);

    $type = InspectionType::factory()->imported()->create();

    $number = app(InspectionNumberGenerator::class)
        ->generate($branch, $type);

    expect($number)
        ->toBe('RUH-IMP-' . now()->year . '-000026');

    expect($branch->fresh()->last_inspection_sequence)
        ->toBe(26);
});
it('uses branch code in inspection number', function () {

    $branch = Branch::factory()->create([
        'code' => 'JED',
    ]);

    $type = InspectionType::factory()->imported()->create();

    $number = app(InspectionNumberGenerator::class)
        ->generate($branch, $type);

    expect($number)
        ->toStartWith('JED-IMP-');
});
it('uses inspection type code', function () {

    $branch = Branch::factory()->create([
        'code' => 'RUH',
    ]);

    $type = InspectionType::factory()->saber()->create();

    $number = app(InspectionNumberGenerator::class)
        ->generate($branch, $type);

    expect($number)
        ->toContain('-SBR-');
});
it('regenerates inspection number with new inspection type', function () {

    $inspection = Inspection::make([
        'inspection_no' => 'RUH-IMP-2026-000123',
    ]);

    $number = app(InspectionNumberGenerator::class)
        ->regenerate($inspection, 'SBR');

    expect($number)
        ->toBe('RUH-SBR-2026-000123');
});
