<?php

namespace App\Livewire\Forms;


use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\SuspensionInspectionCalculator;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;

class SuspensionInspectionForm extends Form
{

    public ?float $front_left = null;
    public ?float $front_right = null;
    public ?float $rear_left = null;
    public ?float $rear_right = null;

    public ?InspectionResult $result = null;

    public ?string $remarks = null;

    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        $suspension = $inspection->suspensionInspection;
        if (! $suspension) {
            return;
        }
        $this->fill(
            [
                'front_left' => $suspension->front_left,
                'front_right' => $suspension->front_right,
                'rear_left' => $suspension->rear_left,
                'rear_right' => $suspension->rear_right,
                'result' => $suspension->result,
                'remarks' => $suspension->remarks,
            ]
        );
    }


    public function rules(): array
    {
        return [
            'front_left' => ['required', 'numeric'],
            'front_right' => ['required', 'numeric'],
            'rear_left' => ['required', 'numeric'],
            'rear_right' => ['required', 'numeric'],
            'result' => ['nullable', new Enum(InspectionResult::class)],
            'remarks' => ['nullable', 'string'],
        ];
    }

    public function data(): array
    {
        return [
            'front_left' => $this->front_left,
            'front_right' => $this->front_right,
            'rear_left' => $this->rear_left,
            'rear_right' => $this->rear_right,
            'result' => $this->result,
            'remarks' => $this->remarks,
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->validate();
        $result =
            app(SuspensionInspectionCalculator::class)
            ->calculate(
                $this->data(),
            );
        $data = $this->data();
        $data['result'] = $result;
        $data['inspected_by'] = Auth::id();
        $inspection->suspensionInspection()->updateOrCreate(
            [],
            $data,
        );
    }
}
