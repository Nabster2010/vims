<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class InspectionForm extends Form
{
    #[validate]
    public ?int $customer_id = null;
    #[validate]
    public ?int $sales_representative_id = null;
    #[validate]
    public ?int $inspection_type_id = null;
    #[validate]
    public string $vin = "";

    protected function rules(): array
    {
        return [
            'inspection_type_id' => ['required', 'exists:inspection_types,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'sales_representative_id' => ['required', 'exists:sales_representatives,id'],
            'vin' => ['required', 'string', 'size:17'],
        ];
    }
}
