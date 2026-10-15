<?php

namespace App\Livewire\Forms;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Models\VisualItem;
use App\Services\VisualInspectionCalculator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class VisualInspectionForm extends Form
{

    // 1. Items array structure: [item_id => ['result' => 'Pass|Fail', 'remarks' => '...']]
    public array $items = [];

    public ?InspectionResult $result = null;

    public ?string $remarks = null;


    //this will initialize the items array with all active visual items related to specific inspection type 
    private function initializeItems(Inspection $inspection): void
    {
        $visualItems = $inspection->inspectionType->visualItems()
            ->where('is_active', true)
            ->orderBy('inspection_type_visual_item.sort_order')
            ->orderBy('visual_items.sort_order')
            ->get();
        foreach ($visualItems as $item) {
            $this->items[$item->id] = [
                'result' => InspectionResult::Pass->value,
                'remarks' => null,
            ];
        }
    }

    public function fillFromInspection(Inspection $inspection): void
    {
        $this->initializeItems($inspection);

        $visualInspection = $inspection->visualInspection;

        if (! $visualInspection) {
            return;
        }
        $this->result = $visualInspection->result;
        $this->remarks = $visualInspection->remarks;

        foreach ($visualInspection->visualItemResults as $itemResult) {

            if (! isset($this->items[$itemResult->visual_item_id])) {
                continue;
            }

            $this->items[$itemResult->visual_item_id]['result']
                = $itemResult->result?->value;

            $this->items[$itemResult->visual_item_id]['remarks']
                = $itemResult->remarks;
        }
    }

    public function rules(): array
    {
        $rules = [
            'remarks' => ['nullable', 'string'],
        ];

        foreach ($this->items as $itemId => $item) {
            $rules["items.{$itemId}.result"] = [
                'required',
                new Enum(InspectionResult::class)
            ];
            $rules["items.{$itemId}.remarks"] = ['nullable', 'string'];
        }

        return $rules;
    }

    public function data(): array
    {
        return $this->items;
    }

    public function save(Inspection $inspection): void
    {

        $this->validate();

        $result = app(VisualInspectionCalculator::class)
            ->calculate($this->items);

        DB::transaction(function () use ($inspection, $result) {

            $visualInspection = $inspection->visualInspection()->updateOrCreate(
                [],
                [
                    'result' => $result,
                    'inspected_by' => Auth::id(),
                    'remarks' => $this->remarks,
                ]
            );

            foreach ($this->items as $visualItemId => $item) {

                $visualInspection->visualItemResults()->updateOrCreate(
                    [
                        'visual_item_id' => $visualItemId,
                    ],
                    [
                        'result' => ! empty($item['result'])
                            ? InspectionResult::from($item['result'])
                            : null,

                        'remarks' => $item['remarks'] ?? null,
                    ],
                );
            }
        });
    }
}
