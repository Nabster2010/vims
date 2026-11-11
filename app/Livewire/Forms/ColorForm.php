<?php

namespace App\Livewire\Forms;

use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ColorForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public bool $is_active = true;

    public function fillFromColor(Color $color): void
    {
        $this->name = $color->name;
        $this->name_ar = $color->name_ar;
        $this->is_active = $color->is_active;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(?Color $color = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colors')
                    ->ignore($color),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colors')
                    ->ignore($color),
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'is_active' => $this->is_active,

        ];
    }

    public function create(): Color
    {
        $this->validate(
            $this->rules()
        );

        return Color::create(
            [
                ...$this->data(),
                'uuid' => Str::uuid(),
            ]
        );
    }

    public function save(Color $color): void
    {
        $this->validate(
            $this->rules($color)
        );

        $color->update(
            $this->data()
        );
    }
}
