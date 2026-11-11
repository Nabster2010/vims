<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Inspection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),

            'photo_type' => fake()->randomElement([
                'front',
                'rear',
                'left',
                'right',
                'vin',
                'dashboard',
                'odometer',
                'engine',
                'interior',
            ]),

            'path' => 'photos/' . fake()->uuid() . '.jpg',

            'remarks' => fake()->optional()->sentence(),

            'sort_order' => fake()->numberBetween(1, 10),

            'uploaded_by' => User::factory(),
        ];
    }

    public function withoutUploader(): static
    {
        return $this->state(fn() => [
            'uploaded_by' => null,
        ]);
    }
}
