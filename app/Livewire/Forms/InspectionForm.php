<?php

namespace App\Livewire\Forms;

use App\Models\Inspection;
use App\Models\InspectionType;
use Illuminate\Validation\Rule;
use Livewire\Form;

class InspectionForm extends Form
{
    // Common Information
    public ?Inspection $inspection = null;

    public ?int $inspection_type_id = null;

    public ?int $customer_id = null;

    public ?int $sales_representative_id = null;

    public string $vin = '';

    public ?string $payment_type = null;

    public ?float $payment_amount = null;

    public ?int $inspection_id = null;

    // Imported Vehicle
    public ?string $request_no = null;

    public ?string $request_date = null;

    public ?string $custom_declaration_no = null;

    public ?string $custom_declaration_date = null;

    public ?int $custom_port_id = null;

    // Saber Inspection

    public ?int $import_country_id = null;

    // Modified Vehicle
    public ?string $plate_no = null;

    public ?string $modification_center = null;

    public ?string $current_type = null;

    public ?string $target_type = null;

    public ?string $owner_id = null;

    public ?string $request_origin = null;

    public ?string $modification_center_report_no = null;

    public ?string $modification_description = null;

    public ?bool $is_authorized_modification_center = false;

    /**
     * @return array<string, mixed>
     */
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
                Rule::unique('inspections')->ignore($this->inspection),
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

            case 'MDL':
            case 'MDH':
                $rules += [
                    'plate_no' => ['required'],
                    'modification_center' => ['nullable', 'string'],
                    'current_type' => ['required'],
                    'target_type' => ['required'],
                    'owner_id' => ['required'],
                    'request_date' => ['required'],
                    'request_origin' => ['nullable', 'string'],
                    'modification_center_report_no' => ['nullable', 'string'],
                    'modification_description' => ['nullable', 'string'],
                    'is_authorized_modification_center' => ['required', 'boolean'],
                ];
                break;
            case 'SBR':
            case 'MTC':
            case 'TRL':
                $rules += [
                    'request_no' => ['required', 'string'],
                    'request_date' => ['required', 'date'],
                    'import_country_id' => ['required', 'exists:countries,id'],
                ];
                break;
        }

        return $rules;
    }

    public function fillFromModel(Inspection $inspection): void
    {
        $this->inspection = $inspection;

        $this->fill([
            'inspection_type_id' => $inspection->inspection_type_id,
            'customer_id' => $inspection->customer_id,
            'sales_representative_id' => $inspection->sales_representative_id,
            'vin' => $inspection->vin,
            'payment_type' => $inspection->payment_type,
            'payment_amount' => $inspection->payment_amount,
            'request_no' => $inspection->request_no,
            'request_date' => $inspection->request_date?->format('Y-m-d'),
            'custom_declaration_no' => $inspection->custom_declaration_no,
            'custom_declaration_date' => $inspection->custom_declaration_date?->format('Y-m-d'),
            'custom_port_id' => $inspection->custom_port_id,
            'import_country_id' => $inspection->import_country_id,
            'plate_no' => $inspection->plate_no,
            'modification_center' => $inspection->modification_center,
            'current_type' => $inspection->current_type,
            'target_type' => $inspection->target_type,
            'owner_id' => $inspection->owner_id,
            'request_origin' => $inspection->request_origin,
            'modification_center_report_no' => $inspection->modification_center_report_no,
            'modification_description' => $inspection->modification_description,
            'is_authorized_modification_center' => $inspection->is_authorized_modification_center,
        ]);

        $this->inspection_id = $inspection->id;
    }

    public function resetTypeFields(): void
    {
        $this->fill([
            'request_no' => null,
            'request_date' => null,
            'custom_declaration_no' => null,
            'custom_declaration_date' => null,
            'custom_port_id' => null,
            'import_country_id' => null,
            'plate_no' => null,
            'modification_center' => null,
            'current_type' => null,
            'target_type' => null,
            'owner_id' => null,
            'request_origin' => null,
            'modification_center_report_no' => null,
            'modification_description' => null,
            'is_authorized_modification_center' => false,
        ]);
    }
    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return $this->all();
    }
}
