<?php

namespace App\Livewire\Forms;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\HeadLightInspectionCalculator;
use App\Services\Inspection\InspectionWorkflowService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class HeadLightInspectionForm extends Form
{
    public ?float $left = null;

    public ?float $right = null;

    public ?InspectionResult $result = null;

    public ?string $remarks = null;

    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        $headlight = $inspection->headlightInspection;
        if (! $headlight) {
            return;
        }
        $this->fill(
            [
                'left' => $headlight->left,
                'right' => $headlight->right,
                'result' => $headlight->result,
                'remarks' => $headlight->remarks,
            ]
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'left' => ['required', 'numeric'],
            'right' => ['required', 'numeric'],
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
            'left' => $this->left,
            'right' => $this->right,
            'result' => $this->result,
            'remarks' => $this->remarks,
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->validate();
        $result =
            app(HeadLightInspectionCalculator::class)
                ->calculate(
                    $this->data(),
                );
        $data = [
            ...$this->data(),
            'inspected_by' => Auth::id(),
            'result' => $result['result'],
        ];
        $inspection->headLightInspection()->updateOrCreate(
            [],
            $data,
        );
        app(InspectionWorkflowService::class)
            ->sync($inspection);
    }
}
