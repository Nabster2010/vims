<?php

namespace Database\Factories;

use App\Models\VisualItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisualItemFactory extends Factory
{
    protected $model = VisualItem::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'name_ar' => fake()->words(2, true),

            'code' => fake()->unique()->bothify('VI-####'),

            'standard' => fake()->optional()->sentence(),

            'category' => fake()->randomElement([
                'Exterior',
                'Interior',
                'Safety',
                'Engine',
            ]),

            'category_ar' => fake()->optional()->words(2, true),

            'description' => fake()->optional()->sentence(),

            'description_ar' => fake()->optional()->sentence(),

            'sort_order' => fake()->numberBetween(1, 100),

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
