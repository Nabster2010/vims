<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Models\SuspensionInspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuspensionInspectionFactory extends Factory
{
    protected $model = SuspensionInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'front_left' => fake()->randomFloat(2, 0, 100),

            'front_right' => fake()->randomFloat(2, 0, 100),

            'rear_left' => fake()->randomFloat(2, 0, 100),

            'rear_right' => fake()->randomFloat(2, 0, 100),

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
