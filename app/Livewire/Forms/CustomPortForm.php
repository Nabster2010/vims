<?php

namespace App\Livewire\Forms;

use App\Models\CustomPort;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CustomPortForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public ?string $code = null;

    public bool $is_active = true;

    public function fillFromCustomPort(CustomPort $customPort): void
    {
        $this->name = $customPort->name;
        $this->name_ar = $customPort->name_ar;
        $this->code = $customPort->code;
        $this->is_active = $customPort->is_active;
    }
    /**
     * @return array<string, mixed>
     */
    public function rules(?CustomPort $customPort = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('custom_ports')
                    ->ignore($customPort),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('custom_ports')
                    ->ignore($customPort),
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('custom_ports')
                    ->ignore($customPort),
            ],

            'is_active' => [
                'boolean',
            ],

        ];
    }

    public function data(): array
    {
        return [

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'code' => $this->code,

            'is_active' => $this->is_active,

        ];
    }

    public function create(): CustomPort
    {
        $this->validate(
            $this->rules()
        );

        return CustomPort::create(
            $this->data()
        );
    }

    public function save(CustomPort $customPort): void
    {

        $this->validate(
            $this->rules($customPort)
        );

        $customPort->update(
            $this->data()
        );
    }
}
