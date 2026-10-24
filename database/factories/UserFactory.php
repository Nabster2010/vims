<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'branch_id' => null,

            'name' => fake()->name(),

            'employee_no' => fake()->unique()->numerify('EMP######'),

            'email' => fake()->unique()->safeEmail(),

            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),

            'role' => UserRole::Receptionist,

            'status' => UserStatus::Active,

            'force_password_change' => false,

            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }

    public function superAdmin(): static
    {
        return $this->state(fn () => [
            'branch_id' => null,
            'role' => UserRole::SuperAdmin,
            'status' => UserStatus::Active,
        ]);
    }

    public function branchManager(int $branchId): static
    {
        return $this->state(fn () => [
            'branch_id' => $branchId,
            'role' => UserRole::BranchManager,
        ]);
    }

    public function receptionist(int $branchId): static
    {
        return $this->state(fn () => [
            'branch_id' => $branchId,
            'role' => UserRole::Receptionist,
        ]);
    }

    public function locked(): static
    {
        return $this->state(fn () => [
            'status' => UserStatus::Locked,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'status' => UserStatus::Inactive,
        ]);
    }
}
