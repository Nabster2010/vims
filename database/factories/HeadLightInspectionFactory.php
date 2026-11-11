<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\HeadLightInspection;
use App\Models\Inspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeadLightInspectionFactory extends Factory
{
    protected $model = HeadLightInspection::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'left' => fake()->randomFloat(2, -5, 5),

            'right' => fake()->randomFloat(2, -5, 5),

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
