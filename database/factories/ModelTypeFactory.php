<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\ModelType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelTypeFactory extends Factory
{
    protected $model = ModelType::class;

    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),

            'manufacturer_id' => Manufacturer::factory(),

            'name' => fake()->unique()->bothify('Model-###'),

            'name_ar' => fake()->unique()->bothify('موديل-###'),

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
