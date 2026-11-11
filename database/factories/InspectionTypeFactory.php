<?php

namespace Database\Factories;

use App\Models\InspectionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionTypeFactory extends Factory
{
    protected $model = InspectionType::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->lexify('???'),
            'name' => fake()->words(2, true),
            'name_ar' => fake()->words(2, true),
            'prefix' => strtoupper(fake()->lexify('???')),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }

    public function imported(): static
    {
        return $this->state(fn () => [
            'code' => 'IMP',
            'name' => 'Imported Vehicle',
            'name_ar' => 'مركبة مستوردة',
            'prefix' => 'IV',
        ]);
    }

    public function saber(): static
    {
        return $this->state(fn () => [
            'code' => 'SBR',
            'name' => 'Saber Vehicle',
            'name_ar' => 'مطابقة سابر',
            'prefix' => 'SB',
        ]);
    }

    public function modifiedLight(): static
    {
        return $this->state(fn () => [
            'code' => 'MDL',
            'name' => 'Modified Light Vehicle',
            'name_ar' => 'مركبة معدلة خفيفة',
            'prefix' => 'ML',
        ]);
    }

    public function modifiedHeavy(): static
    {
        return $this->state(fn () => [
            'code' => 'MDH',
            'name' => 'Modified Heavy Vehicle',
            'name_ar' => 'مركبة معدلة ثقيلة',
            'prefix' => 'MH',
        ]);
    }

    public function motorcycle(): static
    {
        return $this->state(fn () => [
            'code' => 'MTC',
            'name' => 'Motorcycle',
            'name_ar' => 'دراجة نارية',
            'prefix' => 'MC',
        ]);
    }

    public function trailer(): static
    {
        return $this->state(fn () => [
            'code' => 'TRL',
            'name' => 'Trailer',
            'name_ar' => 'مقطورة',
            'prefix' => 'TR',
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
