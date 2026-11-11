<?php

namespace Database\Factories;

use App\Enums\CustomerType;
use App\Enums\IdentityType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'customer_type' => CustomerType::INDIVIDUAL,
            'identity_type' => IdentityType::NationalID,
            'name' => fake()->name(),
            'identity_number' => fake()->unique()->numerify('##########'),
            'vat_number' => null,
            'mobile' => '05'.fake()->numerify('########'),
            'email' => fake()->safeEmail(),
            'address' => fake()->address(),
            'notes' => null,
            'is_active' => true,
        ];
    }

    public function company(): static
    {
        return $this->state(fn () => [
            'customer_type' => CustomerType::COMPANY,
            'identity_type' => IdentityType::CommercialRegistration,
            'name' => fake()->company(),
            'vat_number' => fake()->numerify('###############'),
        ]);
    }

    public function individual(): static
    {
        return $this->state(fn () => [
            'customer_type' => CustomerType::INDIVIDUAL,
            'identity_type' => IdentityType::NationalID,
            'name' => fake()->name(),
            'vat_number' => null,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
