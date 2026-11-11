<?php

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\SalesRepresentative;
use App\Models\User;
use App\Services\InspectionNumberGenerator;
use App\Services\InspectionService;
use Illuminate\Support\Str;
use Mockery;

afterEach(function () {
    Mockery::close();
});

it('creates a new inspection', function () {

    $branch = Branch::factory()->create();
    $type = InspectionType::factory()->imported()->create();

    $generator = Mockery::mock(InspectionNumberGenerator::class);

    $generator
        ->shouldReceive('generate')
        ->once()
        ->withArgs(function (Branch $b, InspectionType $t) use ($branch, $type) {
            return $b->is($branch)
                && $t->is($type);
        })
        ->andReturn('RUH-IMP-000001');

    $service = new InspectionService($generator);

    $inspection = $service->create([
        'branch_id' => $branch->id,
        'inspection_type_id' => $type->id,
        'customer_id' => Customer::factory()->create()->id,
        'sales_representative_id' => SalesRepresentative::factory()->create()->id,
        'vin' => '1HGCM82633A123456',
        'payment_type' => 'Cash',
        'payment_amount' => 100,
        'created_by' => User::factory()->create()->id,
    ]);

    expect($inspection)->toBeInstanceOf(Inspection::class);

    expect($inspection->inspection_no)
        ->toBe('RUH-IMP-000001');

    expect($inspection->status)
        ->toBe(InspectionStatus::Registered);

    expect($inspection->final_result)
        ->toBe(InspectionResult::Pending);

    expect($inspection->uuid)
        ->not->toBeNull();

    expect(Str::isUuid($inspection->uuid))
        ->toBeTrue();

    expect($inspection->registered_at)
        ->not->toBeNull();
});

it('updates inspection without regenerating inspection number', function () {

    $inspection = Inspection::factory()->create();

    $generator = Mockery::mock(InspectionNumberGenerator::class);

    $generator->shouldNotReceive('regenerate');

    $service = new InspectionService($generator);

    $updated = $service->update($inspection, [
        'inspection_type_id' => $inspection->inspection_type_id,
        'remarks' => 'Updated remarks',
    ]);

    expect($updated->remarks)->toBe('Updated remarks');
    expect($updated->inspection_no)->toBe($inspection->inspection_no);
});

it('regenerates inspection number when inspection type changes', function () {

    $inspection = Inspection::factory()->imported()->create();

    $newType = InspectionType::factory()->saber()->create();

    $generator = Mockery::mock(InspectionNumberGenerator::class);

    $generator
        ->shouldReceive('regenerate')
        ->once()
        ->with($inspection, $newType->code)
        ->andReturn('RUH-SBR-000001');

    $service = new InspectionService($generator);

    $updated = $service->update($inspection, [
        'inspection_type_id' => $newType->id,
    ]);

    expect($updated->inspection_type_id)->toBe($newType->id);
    expect($updated->inspection_no)->toBe('RUH-SBR-000001');
});

it('returns fresh inspection after update', function () {

    $inspection = Inspection::factory()->create();

    $generator = Mockery::mock(InspectionNumberGenerator::class);

    $generator->shouldNotReceive('regenerate');

    $service = new InspectionService($generator);

    $updated = $service->update($inspection, [
        'remarks' => 'Fresh model',
        'inspection_type_id' => $inspection->inspection_type_id,
    ]);

    expect($updated->remarks)->toBe('Fresh model');
});
