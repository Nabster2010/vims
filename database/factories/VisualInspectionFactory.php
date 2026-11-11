<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Models\User;
use App\Models\VisualInspection;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisualInspectionFactory extends Factory
{
    protected $model = VisualInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'result' => InspectionResult::Pending,

            'inspected_by' => User::factory(),

            'remarks' => fake()->optional()->sentence(),

            'description' => fake()->optional()->paragraph(),

            'description_ar' => fake()->optional()->paragraph(),
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
