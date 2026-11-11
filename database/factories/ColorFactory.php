<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),

            'name' => fake()->unique()->safeColorName(),

            'name_ar' => fake()->unique()->randomElement([
                'أبيض',
                'أسود',
                'فضي',
                'رمادي',
                'أحمر',
                'أزرق',
                'أخضر',
                'أصفر',
                'بني',
                'برتقالي',
                'ذهبي',
                'بيج',
            ]),

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
