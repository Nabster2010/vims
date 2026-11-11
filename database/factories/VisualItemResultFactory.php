<?php

namespace Database\Factories;

use App\Enums\InspectionResult;
use App\Models\VisualInspection;
use App\Models\VisualItem;
use App\Models\VisualItemResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisualItemResultFactory extends Factory
{
    protected $model = VisualItemResult::class;

    public function definition(): array
    {
        return [
            'visual_inspection_id' => VisualInspection::factory(),

            'visual_item_id' => VisualItem::factory(),

            'result' => InspectionResult::Pending,

            'is_modified' => false,

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

    public function modified(): static
    {
        return $this->state(fn() => [
            'is_modified' => true,
        ]);
    }
}
