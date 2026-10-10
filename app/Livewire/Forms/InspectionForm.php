<?php

namespace App\Livewire\Forms;

use App\Models\InspectionType;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InspectionForm extends Form
{
    /*

    |--------------------------------------------------------------------------
    | Common Information
    |--------------------------------------------------------------------------

    */

    #[Validate]
    public ?int $inspection_type_id = null;

    #[Validate]
    public ?int $customer_id = null;

    #[Validate]
    public ?int $sales_representative_id = null;

    #[Validate]
    public string $vin = '';

    #[Validate]
    public ?string $payment_type = null;

    #[Validate]
    public ?float $payment_amount = null;

    public ?int $inspectionId = null;

    /*

    |--------------------------------------------------------------------------
    | Imported Vehicle
    |--------------------------------------------------------------------------

    */

    public ?string $request_no = null;

    public ?string $request_date = null;

    public ?string $custom_declaration_no = null;

    public ?string $custom_declaration_date = null;

    public ?int $custom_port_id = null;

    /*

    |--------------------------------------------------------------------------
    | Saber Inspection
    |--------------------------------------------------------------------------

    */

    public ?int $import_country_id = null;

    /*

    |--------------------------------------------------------------------------
    | Modified Vehicle
    |--------------------------------------------------------------------------

    */

    public ?string $plate_no = null;

    public ?string $modification_center = null;

    public ?string $current_type = null;

    public ?string $target_type = null;

    public ?string $owner_id = null;

    protected function rules(): array
    {
        $rules = [
            'inspection_type_id' => ['required', 'exists:inspection_types,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'sales_representative_id' => ['required', 'exists:sales_representatives,id'],
            'vin' => [
                'required',
                'string',
                'size:17',
                Rule::unique('inspections', 'vin')->ignore($this->inspectionId),
            ],
            'payment_type' => ['required'],
            'payment_amount' => ['required', 'numeric', 'min:0'],

        ];
        $inspectionType = InspectionType::query()
            ->select('id', 'code')
            ->find($this->inspection_type_id);
        if (! $inspectionType) {
            return $rules;
        }
        switch ($inspectionType->code) {

            case 'IMP':

                $rules += [
                    'request_no' => ['required', 'string'],
                    'request_date' => ['required', 'date'],
                    'custom_declaration_no' => ['required', 'string'],
                    'custom_declaration_date' => ['required', 'date'],
                    'custom_port_id' => ['required', 'exists:custom_ports,id'],

                ];

                break;

            case 'SBG':
            case 'SBE':
            case 'MTC':

                $rules += [
                    'request_no' => ['required', 'string'],
                    'request_date' => ['required', 'date'],
                    'import_country_id' => ['required', 'exists:countries,id'],
                ];

                break;

            case 'MDL':
            case 'MDH':

                $rules += [

                    'plate_no' => ['required'],
                    'modification_center' => ['nullable', 'string'],
                    'current_type' => ['required'],
                    'target_type' => ['required'],
                    'owner_id' => ['required'],

                ];

                break;
        }

        return $rules;
    }
}
