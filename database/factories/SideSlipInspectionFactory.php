<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Models\SideSlipInspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SideSlipInspectionFactory extends Factory
{
    protected $model = SideSlipInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'value' => fake()->randomFloat(2, -20, 20),

            'result' => InspectionResult::Pending,

            'inspected_by' => User::factory(),

            'remarks' => fake()->optional()->sentence(),
        ];
    }

    public function passed(): static
    {
        return $this->state(fn () => [
            'result' => InspectionResult::Pass,
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn () => [
            'result' => InspectionResult::Fail,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'result' => InspectionResult::Pending,
        ]);
    }
}
