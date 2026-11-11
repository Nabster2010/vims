<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\BrakeInspection;
use App\Models\Inspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrakeInspectionFactory extends Factory
{
    protected $model = BrakeInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'front' => fake()->randomFloat(2, 60, 100),

            'rear' => fake()->randomFloat(2, 40, 100),

            'parking' => fake()->randomFloat(2, 16, 50),

            'result' => InspectionResult::Pending,

            'inspected_by' => User::factory(),

            'remarks' => fake()->optional()->sentence(),
        ];
    }

    public function passed(): static
    {
        return $this->state(fn() => [
            'result' => InspectionResult::Pass,
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn() => [
            'result' => InspectionResult::Fail,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn() => [
            'result' => InspectionResult::Pending,
        ]);
    }
}
