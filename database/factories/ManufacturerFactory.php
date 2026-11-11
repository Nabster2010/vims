<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ManufacturerFactory extends Factory
{
    protected $model = Manufacturer::class;

    public function definition(): array
    {
        return [

            'uuid' => (string) Str::uuid(),

            'name' => fake()->unique()->company(),

            'name_ar' => fake()->unique()->company(),

            'country_id' => Country::factory(),

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    public function withoutCountry(): static
    {
        return $this->state(fn () => [
            'country_id' => null,
        ]);
    }
}
