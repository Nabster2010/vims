<?php

namespace App\Livewire\Forms;

use App\Models\InspectionType;
use Livewire\Form;

class InspectionTypeForm extends Form
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $name_ar = null;

    public ?string $prefix = null;

    public ?string $code = null;

    public ?string $description = null;

    public bool $is_active = true;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'max:10'],
            'code' => ['required', 'string', 'max:10', 'unique:inspection_types,code,'.$this->id],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    public function fillFromModel(InspectionType $inspectionType): void
    {
        $this->fill([
            'name' => $inspectionType->name,
            'name_ar' => $inspectionType->name_ar,
            'prefix' => $inspectionType->prefix,
            'code' => $inspectionType->code,
            'description' => $inspectionType->description,
            'is_active' => $inspectionType->is_active,
        ]);
        $this->id = $inspectionType->id;
    }

    public function save(): InspectionType
    {
        $this->validate();

        return InspectionType::updateOrCreate(
            ['id' => $this->id],
            $this->all()
        );
    }
}
