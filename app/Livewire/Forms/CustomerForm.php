<?php

namespace App\Livewire\Forms;

use App\Enums\CustomerType;
use App\Enums\IdentityType;
use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    #[Validate]
    public CustomerType $customer_type = CustomerType::INDIVIDUAL;

    #[Validate]
    public IdentityType $identity_type = IdentityType::NationalID;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $identity_number = '';

    #[Validate]
    public ?string $vat_number = null;

    #[Validate]
    public string $mobile = '';

    #[Validate]
    public ?string $email = null;

    #[Validate]
    public ?string $address = null;

    #[Validate]
    public ?string $notes = null;


    protected function rules(): array
    {
        return [
            'customer_type'   => ['required'],
            'identity_type'   => ['required'],
            'name'            => ['required', 'string', 'max:255'],
            'identity_number' => ['required', 'string', 'max:255'],
            'vat_number'      => ['nullable', 'string', 'max:255'],
            'mobile'          => ['required', 'string', 'max:30'],
            'email'           => ['nullable', 'email'],
            'address'         => ['nullable', 'string'],
            'notes'           => ['nullable', 'string'],
        ];
    }

    public function setCustomer(Customer $customer): void
    {
        $this->fill([
            'customer_type' => $customer->customer_type,
            'identity_type' => $customer->identity_type,
            'name' => $customer->name,
            'identity_number' => $customer->identity_number,
            'vat_number' => $customer->vat_number,
            'mobile' => $customer->mobile,
            'email' => $customer->email,
            'address' => $customer->address,
            'notes' => $customer->notes,
        ]);
    }
    public function data(): array
    {
        return $this->all();
    }
}
