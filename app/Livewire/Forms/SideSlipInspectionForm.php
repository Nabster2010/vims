<?php

namespace App\Livewire\Forms;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\Inspection\InspectionWorkflowService;
use App\Services\SideSlipInspectionCalculator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class SideSlipInspectionForm extends Form
{
    public ?float $value = null;

    public ?InspectionResult $result = null;

    public ?string $remarks = null;

    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        $sideSlip = $inspection->sideSlipInspection;
        if (! $sideSlip) {
            return;
        }
        $this->fill(
            [
                'value' => $sideSlip->value,
                'result' => $sideSlip->result,
                'remarks' => $sideSlip->remarks,
            ]
        );
    }
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric'],
            'result' => ['nullable', new Enum(InspectionResult::class)],
            'remarks' => ['nullable', 'string'],
        ];
    }
    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'value' => $this->value,
            'result' => $this->result,
            'remarks' => $this->remarks,
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->validate();
        $result =
            app(SideSlipInspectionCalculator::class)
            ->calculate(
                $this->data(),
            );
        $data = [
            ...$this->data(),
            'result' => $result['result'],
            'inspected_by' => Auth::id(),
        ];
        $inspection->sideSlipInspection()->updateOrCreate(
            [],
            $data,
        );
        app(InspectionWorkflowService::class)
            ->sync($inspection);
    }
}
