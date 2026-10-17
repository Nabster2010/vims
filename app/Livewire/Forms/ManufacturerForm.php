<?php

namespace App\Livewire\Forms;

use App\Models\Manufacturer;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ManufacturerForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public bool $is_active = true;

    public ?int $country_id = null;

    public function fillFromManufacturer(Manufacturer $manufacturer): void
    {
        $this->name = $manufacturer->name;
        $this->name_ar = $manufacturer->name_ar;
        $this->is_active = $manufacturer->is_active;
        $this->country_id = $manufacturer->country_id;
    }

    public function rules(?Manufacturer $manufacturer = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('manufacturers')
                    ->ignore($manufacturer),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('manufacturers')
                    ->ignore($manufacturer),
            ],

            'is_active' => [
                'boolean',
            ],

            'country_id' => [
                'nullable',
                'integer',
                'exists:countries,id',
            ],

        ];
    }

    public function data(): array
    {
        return [

            'name' => $this->name,
            'uuid' => Str::uuid(),
            'name_ar' => $this->name_ar,
            'country_id' => $this->country_id,
            'is_active' => $this->is_active,

        ];
    }

    public function create(): Manufacturer
    {
        $this->validate(
            $this->rules()
        );

        return Manufacturer::create(
            $this->data()
        );
    }

    public function save(Manufacturer $manufacturer): void
    {
        $this->validate(
            $this->rules($manufacturer)
        );

        $manufacturer->update(
            $this->data()
        );
    }
}
