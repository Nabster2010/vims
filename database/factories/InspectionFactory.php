<?php

namespace Database\Factories;

use App\Enums\InspectionStatus;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InspectionFactory extends Factory
{
    protected $model = Inspection::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),

            'inspection_no' => 'TEST-' . fake()->unique()->numerify('######'),

            'branch_id' => Branch::factory(),

            'inspection_type_id' => InspectionType::factory(),

            'customer_id' => Customer::factory(),

            'sales_representative_id' => null,

            'vin' => strtoupper(fake()->bothify('#################')),

            'request_no' => null,
            'request_date' => null,
            'request_origin' => null,

            'modification_center_report_no' => null,
            'modification_description' => null,
            'is_authorized_modification_center' => false,

            'custom_declaration_no' => null,
            'custom_declaration_date' => null,
            'custom_port_id' => null,

            'payment_type' => null,
            'payment_amount' => null,

            'import_country_id' => null,

            'plate_no' => null,

            'modification_center' => null,

            'current_type' => null,
            'target_type' => null,

            'owner_id' => null,

            'status' => InspectionStatus::Registered,

            'final_result' => null,

            'created_by' => User::factory(),

            'inspector_id' => null,

            'approved_by' => null,

            'registered_at' => now(),

            'inspection_started_at' => null,

            'inspection_completed_at' => null,

            'approved_at' => null,

            'reinspection_count' => 0,

            'is_locked' => false,

            'remarks' => null,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Inspection Types
    |--------------------------------------------------------------------------
    */

    public function imported(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->imported(),
        ]);
    }

    public function saber(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->saber(),
        ]);
    }

    public function modifiedLight(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->modifiedLight(),
        ]);
    }

    public function modifiedHeavy(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->modifiedHeavy(),
        ]);
    }

    public function motorcycle(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->motorcycle(),
        ]);
    }

    public function trailer(): static
    {
        return $this->state(fn() => [
            'inspection_type_id' => InspectionType::factory()->trailer(),
        ]);
    }
}
