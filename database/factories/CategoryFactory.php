<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),

            'name' => fake()->unique()->bothify('Category-###'),

            'name_ar' => fake()->unique()->bothify('فئة-###'),

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn() => [
            'is_active' => false,
        ]);
    }
}
