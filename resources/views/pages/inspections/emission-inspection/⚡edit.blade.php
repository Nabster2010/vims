<?php

use App\Livewire\Forms\EmissionInspectionForm;
use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Services\EmissionInspectionCalculator;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;
use Flux\Flux;

new class extends BasePage {
    public Inspection $inspection;

    public EmissionInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);
        $this->inspection = $inspection->loadMissing('vehicleInformation', 'emissionInspection');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function fuelType(): ?FuelType
    {
        return $this->inspection->vehicleInformation?->fuel_type;
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        if (!$this->fuelType) {
            return [
                'result' => null,
                'failedItems' => [],
            ];
        }

        return app(EmissionInspectionCalculator::class)->calculate($this->fuelType, $this->form->data());
    }
    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);
        $this->form->save($this->inspection);

        Flux::toast(variant: 'success', text: 'Emission inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} emission inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->fuelType)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            @switch($this->fuelType)
                @case(\App\Enums\FuelType::Gasoline)
                @case(\App\Enums\FuelType::Hybrid)

                @case(\App\Enums\FuelType::Phev)
                    <x-inspection.emission-inspection.gasoline />
                @break

                @case(\App\Enums\FuelType::Diesel)
                    <x-inspection.emission-inspection.diesel />
                @break

                @case(\App\Enums\FuelType::Ev)
                    <x-inspection.emission-inspection.electric />
                @break
            @endswitch
        @endif
        <x-inspection.result-summary :result="$this->calculatedResult['result']" :failed-items="$this->calculatedResult['failedItems']" />

        @if ($this->inspection->vehicleInformation && $this->inspection->vehicleInformation->fuel_type !== FuelType::Ev)
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit"
                :disabled="$this->fuelType === FuelType::Ev || $this->inspection->vehicleInformation === null || $this->inspection->is_locked">
                Save Emission Inspection
            </flux:button>
        </div>

    </form>
    </section>


</x-ui.page>
