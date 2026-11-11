<?php

namespace App\Livewire\Forms;

use App\Enums\CustomerType;
use App\Enums\IdentityType;
use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    #[Validate('required')]
    public CustomerType $customer_type = CustomerType::INDIVIDUAL;

    #[Validate('required')]
    public IdentityType $identity_type = IdentityType::NationalID;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:255')]
    public string $identity_number = '';

    #[Validate('nullable|string|max:255')]
    public ?string $vat_number = null;

    #[Validate('required|string|max:30')]
    public string $mobile = '';

    #[Validate('nullable|email|max:255')]
    public ?string $email = null;

    #[Validate('nullable|string|max:1000')]
    public ?string $address = null;

    #[Validate('nullable|string|max:1000')]
    public ?string $notes = null;

    /**
     * Populate the form from an existing customer.
     */
    public function fillFromModel(Customer $customer): void
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
}
