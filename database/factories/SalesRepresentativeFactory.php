<?php

namespace Database\Factories;

use App\Models\SalesRepresentative;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRepresentativeFactory extends Factory
{
    protected $model = SalesRepresentative::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'company_name' => fake()->optional()->company(),

            'mobile' => fake()->optional()->numerify('05########'),

            'email' => fake()->optional()->safeEmail(),

            'notes' => fake()->optional()->sentence(),

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    public function company(string $company): static
    {
        return $this->state(fn () => [
            'company_name' => $company,
        ]);
    }
}
