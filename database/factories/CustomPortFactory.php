<?php

namespace Database\Factories;

use App\Models\CustomPort;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomPortFactory extends Factory
{
    protected $model = CustomPort::class;

    public function definition(): array
    {
        return [

            'name' => fake()->unique()->city() . ' Port',

            'name_ar' => fake()->unique()->city(),

            'code' => strtoupper(fake()->unique()->bothify('CP###')),

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
