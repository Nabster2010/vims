<?php

namespace App\Livewire\Forms;

use App\Models\InspectionType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Form;

class InspectionTypeVisualInspectionForm extends Form
{
    public array $items = [];

    public function fillFromInspectionType(InspectionType $inspectionType, Collection $visualItems): void
    {
        $inspectionType = $inspectionType->loadMissing('visualItems');
        foreach ($visualItems as $visualItem) {
            $pivot = $inspectionType->visualItems->firstWhere('id', $visualItem->id)?->pivot;
            $this->items[$visualItem->id] = [
                'selected' => $pivot !== null,
                'required' => $pivot?->is_required ?? true,
                'sort_order' => $pivot?->sort_order ?? $visualItem->sort_order,
            ];
        }
    }

    public function rules(): array
    {
        $rules = [];

        foreach ($this->items as $itemId => $item) {

            $rules["items.$itemId.selected"] = ['boolean'];

            $rules["items.$itemId.required"] = ['boolean'];

            $rules["items.$itemId.sort_order"] = [
                'required',
                'integer',
                'min:1',
            ];
        }

        return $rules;
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'items' => $this->items,
        ];
    }

    public function save(InspectionType $inspectionType): void
    {
        $this->validate();
        $syncData = [];
        foreach ($this->items as $itemId => $item) {
            if (! $item['selected']) {
                continue;
            }
            $syncData[$itemId] = [
                'is_required' => $item['required'],
                'sort_order' => $item['sort_order'],
            ];
        }
        $inspectionType->visualItems()->sync($syncData);
    }
}
