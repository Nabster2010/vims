<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ImportedVehicleRegistrationForm extends Form
{
    #[Validate]
    public string $request_no = '';

    #[Validate]
    public string $request_date = '';

    #[Validate]
    public string $custom_declaration_no = '';

    #[Validate]
    public string $custom_declaration_date = '';

    #[Validate]
    public ?int $custom_port_id = null;

    #[Validate]
    public string $payment_type = '';

    protected function rules(): array
    {
        return [
            'request_no' => ['required', 'string', 'max:255'],

            'request_date' => ['required', 'date'],

            'custom_declaration_no' => ['required', 'string', 'max:255'],

            'custom_declaration_date' => ['required', 'date'],

            'custom_port_id' => ['required', 'exists:custom_ports,id'],

            'payment_type' => ['required'],
        ];
    }
}
