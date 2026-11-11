<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\EmissionInspection;
use App\Models\Inspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmissionInspectionFactory extends Factory
{
    protected $model = EmissionInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'hc' => fake()->randomFloat(2, 0, 500),

            'co' => fake()->randomFloat(2, 0, 10),

            'lambda' => fake()->randomFloat(3, 0.800, 1.200),

            'opacity' => fake()->randomFloat(2, 0, 100),

            'result' => InspectionResult::Pending,

            'remarks' => fake()->optional()->sentence(),

            'inspected_by' => User::factory(),
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
