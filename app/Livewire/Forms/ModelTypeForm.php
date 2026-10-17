<?php

namespace App\Livewire\Forms;

use App\Models\ModelType;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ModelTypeForm extends Form
{
    public ?int $manufacturer_id = null;

    public ?string $name = null;

    public ?string $name_ar = null;

    public bool $is_active = true;

    public function fillFromModelType(ModelType $modelType): void
    {
        $this->manufacturer_id = $modelType->manufacturer_id;
        $this->name = $modelType->name;
        $this->name_ar = $modelType->name_ar;
        $this->is_active = $modelType->is_active;
    }

    public function rules(?ModelType $modelType = null): array
    {
        return [

            'manufacturer_id' => [
                'required',
                'exists:manufacturers,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',

                Rule::unique('model_types')
                    ->where(fn($query) => $query->where(
                        'manufacturer_id',
                        $this->manufacturer_id
                    ))
                    ->ignore($modelType),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',

                Rule::unique('model_types')
                    ->where(fn($query) => $query->where(
                        'manufacturer_id',
                        $this->manufacturer_id
                    ))
                    ->ignore($modelType),
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }

    public function data(): array
    {
        return [

            'manufacturer_id' => $this->manufacturer_id,
            'uuid' => Str::uuid(),

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'is_active' => $this->is_active,

        ];
    }

    public function create(): ModelType
    {
        $this->validate(
            $this->rules()
        );

        return ModelType::create(
            $this->data()
        );
    }

    public function save(ModelType $modelType): void
    {
        $this->validate(
            $this->rules($modelType)
        );

        $modelType->update(
            $this->data()
        );
    }
}
