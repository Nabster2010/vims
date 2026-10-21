<?php

namespace App\Livewire\Forms;

use App\Enums\FuelType;
use App\Enums\InspectionResult;
use App\Models\Inspection;
use App\Services\EmissionInspectionCalculator;
use App\Services\Inspection\InspectionWorkflowService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class EmissionInspectionForm extends Form
{


    protected ?FuelType $fuel_type = null;

    public ?float $hc = null;

    public ?float $co = null;

    public ?float $lambda = null;

    public ?float $opacity = null;

    public ?InspectionResult $result = null;

    public ?string $remarks = null;



    /**
     * Load inspection data
     */
    public function fillFromInspection(Inspection $inspection): void
    {
        $vehicle = $inspection->vehicleInformation;
        if (! $vehicle) {
            return;
        }
        $emission = $inspection->emissionInspection;
        if (! $emission) {
            return;
        }
        $this->fill(
            $emission->only([
                'hc',
                'co',
                'lambda',
                'opacity',
                'result',
                'remarks',
            ])
        );
    }


    public function rules(): array
    {
        $rules = [
            'result' => ['nullable', new Enum(InspectionResult::class)],
            'remarks' => ['nullable', 'string'],
        ];

        if ($this->fuel_type === null) {
            return $rules;
        }

        switch ($this->fuel_type) {
            case FuelType::Diesel:
                $rules += [
                    'opacity' => ['required', 'numeric'],
                ];
                break;
            case FuelType::Gasoline:
            case FuelType::Hybrid:
            case FuelType::Phev:
                $rules += [
                    'hc' => ['required', 'numeric'],
                    'co' => ['required', 'numeric'],
                ];
                break;
            case FuelType::Ev:
                // No specific fields for EV
                break;
        }

        return $rules;
    }

    public function data(): array
    {
        return [
            'hc' => $this->hc,
            'co' => $this->co,
            'lambda' => $this->lambda,
            'opacity' => $this->opacity,
            'result' => $this->result,
        ];
    }

    public function save(Inspection $inspection): void
    {
        $this->fuel_type = $inspection->vehicleInformation->fuel_type;
        $this->validate();
        $result =
            app(EmissionInspectionCalculator::class)
            ->calculate(
                $this->fuel_type,
                $this->data(),
            );
        $data = [
            ...$this->data(),
            'result' => $result['result'],
            'inspected_by' => Auth::id(),
        ];
        $inspection->emissionInspection()->updateOrCreate(
            [],
            $data,
        );
        app(InspectionWorkflowService::class)
            ->sync($inspection);
    }
}
