<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?string $name = null;

    public ?string $name_ar = null;

    public bool $is_active = true;

    public function fillFromCategory(Category $category): void
    {
        $this->name = $category->name;
        $this->name_ar = $category->name_ar;
        $this->is_active = $category->is_active;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(?Category $category = null): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')
                    ->ignore($category),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')
                    ->ignore($category),
            ],

            'is_active' => [
                'boolean',
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

            'is_active' => $this->is_active,

        ];
    }

    public function create(): Category
    {
        $this->validate(
            $this->rules()
        );

        return Category::create(
            [
                ...$this->data(),
                'uuid' => Str::uuid(),
            ]
        );
    }

    public function save(Category $category): void
    {
        $this->validate(
            $this->rules($category)
        );

        $category->update(
            $this->data()
        );
    }
}
