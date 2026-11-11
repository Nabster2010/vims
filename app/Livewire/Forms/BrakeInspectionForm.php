<?php

namespace App\Livewire\Forms;

use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\BrakeInspectionCalculator;
use App\Services\Inspection\InspectionWorkflowService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class BrakeInspectionForm extends Form
{
    public ?float $front = null;

    public ?float $rear = null;

    public ?float $parking = null;

    public ?InspectionResult $result = null;

    public ?string $remarks = null;

    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        $brake = $inspection->brakeInspection;
        if (! $brake) {
            return;
        }
        $this->fill(
            [
                'front' => $brake->front,
                'rear' => $brake->rear,
                'parking' => $brake->parking,
                'result' => $brake->result,
                'remarks' => $brake->remarks,
            ]
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'front' => ['required', 'numeric'],
            'rear' => ['required', 'numeric'],
            'parking' => ['required', 'numeric'],
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
            'front' => $this->front,
            'rear' => $this->rear,
            'parking' => $this->parking,
            'result' => $this->result,
            'remarks' => $this->remarks,
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->validate();
        $result =
            app(BrakeInspectionCalculator::class)
                ->calculate(
                    $this->data(),
                );
        $data = [
            ...$this->data(),
            'result' => $result['result'],
            'inspected_by' => Auth::id(),
        ];

        $inspection->brakeInspection()->updateOrCreate(
            [],
            $data,
        );
        app(InspectionWorkflowService::class)
            ->sync($inspection);
    }
}
