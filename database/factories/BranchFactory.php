<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),

            'name' => fake()->company(),

            'name_ar' => fake()->company(),

            'code' => strtoupper(fake()->unique()->lexify('BR???')),

            'address' => fake()->address(),

            'manager_id' => null,

            'phone' => fake()->phoneNumber(),

            'email' => fake()->safeEmail(),

            'logo_path' => null,

            'stamp_path' => null,

            'last_inspection_sequence' => 0,

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    public function withManager(): static
    {
        return $this->state(fn () => [
            'manager_id' => User::factory(),
        ]);
    }
}
