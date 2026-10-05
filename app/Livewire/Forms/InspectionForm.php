<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class InspectionForm extends Form
{

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
            'inspection_type_id' => ['required'],
            // 'customer_id' => ['required', 'exists:customers,id'],
            'sales_representative_id' => ['required'],
            'vin' => ['required', 'string', 'size:17'],
        ];
    }
}
