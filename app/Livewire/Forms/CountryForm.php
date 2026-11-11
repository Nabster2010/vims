<?php

namespace App\Livewire\Forms;

use App\Models\Country;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CountryForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public ?string $iso2 = null;

    public ?string $iso3 = null;

    public bool $is_active = true;

    public function fillFromCountry(Country $country): void
    {
        $this->name = $country->name;
        $this->name_ar = $country->name_ar;
        $this->iso2 = $country->iso2;
        $this->iso3 = $country->iso3;
        $this->is_active = $country->is_active;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(?Country $country = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries')
                    ->ignore($country),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',

            ],

            'iso2' => [
                'required',
                'string',
                'size:2',
                Rule::unique('countries')
                    ->ignore($country),
            ],

            'iso3' => [
                'required',
                'string',
                'size:3',
                Rule::unique('countries')
                    ->ignore($country),
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

            'iso2' => strtoupper($this->iso2),

            'iso3' => strtoupper($this->iso3),

            'is_active' => $this->is_active,

        ];
    }

    public function create(): Country
    {
        $this->validate(
            $this->rules()
        );

        return Country::create(
            $this->data()
        );
    }

    public function save(Country $country): void
    {
        $this->validate(
            $this->rules($country)
        );

        $country->update(
            $this->data()
        );
    }
}
