<?php

namespace App\Livewire\Forms;

use App\Models\SalesRepresentative;
use Illuminate\Validation\Rule;
use Livewire\Form;

class SalesRepresentativeForm extends Form
{
    public ?string $name = null;

    public ?string $company_name = null;

    public ?string $mobile = null;

    public ?string $email = null;

    public ?string $notes = null;

    public bool $is_active = true;

    public function fillFromSalesRepresentative(SalesRepresentative $salesRepresentative): void
    {
        $this->name = $salesRepresentative->name;
        $this->company_name = $salesRepresentative->company_name;
        $this->mobile = $salesRepresentative->mobile;
        $this->email = $salesRepresentative->email;
        $this->notes = $salesRepresentative->notes;
        $this->is_active = $salesRepresentative->is_active;
    }

    public function rules(?SalesRepresentative $salesRepresentative = null): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sales_representatives', 'name')
                    ->ignore($salesRepresentative),

            ],

            'company_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'company_name' => $this->company_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'notes' => $this->notes,
            'is_active' => $this->is_active,
        ];
    }

    public function create()
    {
        $this->validate($this->rules());
        return SalesRepresentative::create($this->data());
    }

    public function save(SalesRepresentative $salesRepresentative): void
    {
        $this->validate($this->rules($salesRepresentative));
        $salesRepresentative->update($this->data());
    }
}
