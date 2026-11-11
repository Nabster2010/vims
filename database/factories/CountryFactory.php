<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [

            'name' => fake()->unique()->country(),

            'name_ar' => fake()->unique()->country(),

            'iso2' => strtoupper(fake()->unique()->lexify('??')),

            'iso3' => strtoupper(fake()->unique()->lexify('???')),

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
