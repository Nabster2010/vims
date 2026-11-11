<?php

namespace App\Livewire\Forms;

use App\Models\VisualItem;
use Illuminate\Validation\Rule;
use Livewire\Form;

class VisualItemForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public ?string $code = null;

    public ?string $category = null;

    public ?string $category_ar = null;

    public int $sort_order = 0;

    public bool $is_active = true;

    public ?string $description = null;

    public ?string $description_ar = null;

    public function fillFromVisualItem(VisualItem $visualItem): void
    {
        $this->name = $visualItem->name;
        $this->name_ar = $visualItem->name_ar;
        $this->code = $visualItem->code;
        $this->category = $visualItem->category;
        $this->category_ar = $visualItem->category_ar;
        $this->sort_order = $visualItem->sort_order;
        $this->is_active = $visualItem->is_active;
        $this->description = $visualItem->description;
        $this->description_ar = $visualItem->description_ar;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(?VisualItem $visualItem = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('visual_items')
                    ->ignore($visualItem),
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'category_ar' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'boolean',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'description_ar' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'code' => $this->code,

            'category' => $this->category,

            'category_ar' => $this->category_ar,

            'sort_order' => $this->sort_order,

            'is_active' => $this->is_active,

            'description' => $this->description,

            'description_ar' => $this->description_ar,

        ];
    }

    public function create(): VisualItem
    {
        $this->validate(
            $this->rules()
        );

        return VisualItem::create(
            $this->data()
        );
    }

    public function save(VisualItem $visualItem): void
    {
        $this->validate(
            $this->rules($visualItem)
        );

        $visualItem->update(
            $this->data()
        );
    }
}
