<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Enums\InspectionStatus;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomPort;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\SalesRepresentative;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InspectionFactory extends Factory
{
    protected $model = Inspection::class;

    public function definition(): array
    {
        return [

            'uuid' => (string) Str::uuid(),

            // يولده النظام الحقيقي، أما في الاختبارات فنستخدم قيمة صالحة فقط
            'inspection_no' => fake()->unique()->bothify('TEST-########'),

            'branch_id' => Branch::factory(),

            'inspection_type_id' => InspectionType::factory()->imported(),

            'customer_id' => Customer::factory(),

            'sales_representative_id' => SalesRepresentative::factory(),

            'vin' => strtoupper(fake()->bothify('?????????????????')),

            'request_no' => null,

            'request_date' => null,

            'request_origin' => null,

            'modification_center_report_no' => null,

            'modification_description' => null,

            'is_authorized_modification_center' => false,

            'custom_declaration_no' => null,

            'custom_declaration_date' => null,

            'custom_port_id' => null,

            'payment_type' => 'Cash',

            'payment_amount' => fake()->randomFloat(2, 100, 1000),

            'import_country_id' => null,

            'plate_no' => null,

            'modification_center' => null,

            'current_type' => null,

            'target_type' => null,

            'owner_id' => null,

            'status' => InspectionStatus::Registered,

            'final_result' => InspectionResult::Pending,

            'created_by' => User::factory(),

            'inspector_id' => null,

            'approved_by' => null,

            'registered_at' => now(),

            'inspection_started_at' => null,

            'inspection_completed_at' => null,

            'approved_at' => null,

            'reinspection_count' => 0,

            'is_locked' => false,

            'remarks' => fake()->optional()->sentence(),
        ];
    }

    public function inProgress(): static
    {
        return $this->state(fn () => [
            'status' => InspectionStatus::InProgress,
            'inspection_started_at' => now(),
        ]);
    }

    public function pendingApproval(): static
    {
        return $this->state(fn () => [
            'status' => InspectionStatus::PendingApproval,
            'inspection_started_at' => now()->subMinutes(30),
            'inspection_completed_at' => now(),
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => InspectionStatus::Approved,
            'approved_by' => User::factory(),
            'approved_at' => now(),
        ]);
    }

    public function passed(): static
    {
        return $this->state(fn () => [
            'final_result' => InspectionResult::Pass,
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn () => [
            'final_result' => InspectionResult::Fail,
        ]);
    }

    public function reinspection(int $count = 1): static
    {
        return $this->state(fn () => [
            'status' => InspectionStatus::Reinspection,
            'reinspection_count' => $count,
        ]);
    }

    public function locked(): static
    {
        return $this->state(fn () => [
            'is_locked' => true,
        ]);
    }

    public function withInspector(): static
    {
        return $this->state(fn () => [
            'inspector_id' => User::factory(),
            'inspection_started_at' => now(),
        ]);
    }

    public function imported(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->imported();

            return [
                'inspection_type_id' => $type,
                'request_no' => fake()->numerify('REQ-######'),
                'request_date' => today(),
                'custom_declaration_no' => fake()->numerify('CD########'),
                'custom_declaration_date' => today(),
                'custom_port_id' => CustomPort::factory(),
            ];
        });
    }

    public function saber(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->saber();

            return [
                'inspection_type_id' => $type,
                'request_no' => fake()->numerify('REQ-######'),
                'request_date' => today(),
                'import_country_id' => Country::factory(),
            ];
        });
    }

    public function modifiedLight(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->modifiedLight();

            return [
                'inspection_type_id' => $type,
                'plate_no' => strtoupper(fake()->bothify('??? ####')),
                'modification_center' => fake()->company(),
                'current_type' => 'Sedan',
                'target_type' => 'SUV',
                'owner_id' => fake()->numerify('##########'),
                'request_date' => today(),
                'request_origin' => fake()->company(),
                'modification_center_report_no' => fake()->numerify('RPT######'),
                'modification_description' => fake()->sentence(),
                'is_authorized_modification_center' => true,
            ];
        });
    }

    public function modifiedHeavy(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->modifiedHeavy();

            return [
                'inspection_type_id' => $type,
                'plate_no' => strtoupper(fake()->bothify('??? ####')),
                'modification_center' => fake()->company(),
                'current_type' => 'Truck',
                'target_type' => 'Heavy Truck',
                'owner_id' => fake()->numerify('##########'),
                'request_date' => today(),
                'request_origin' => fake()->company(),
                'modification_center_report_no' => fake()->numerify('RPT######'),
                'modification_description' => fake()->sentence(),
                'is_authorized_modification_center' => true,
            ];
        });
    }

    public function motorcycle(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->motorcycle();

            return [
                'inspection_type_id' => $type,
                'request_no' => fake()->numerify('REQ-######'),
                'request_date' => today(),
                'import_country_id' => Country::factory(),
            ];
        });
    }

    public function trailer(): static
    {
        return $this->state(function () {

            $type = InspectionType::factory()->trailer();

            return [
                'inspection_type_id' => $type,
                'request_no' => fake()->numerify('REQ-######'),
                'request_date' => today(),
                'import_country_id' => Country::factory(),
            ];
        });
    }
}
