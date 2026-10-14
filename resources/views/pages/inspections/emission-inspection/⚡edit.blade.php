<?php

use Livewire\Component;
use App\Livewire\Forms\EmissionInspectionForm;
use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Services\EmissionInspectionCalculator;

new class extends Component {
    public Inspection $inspection;

    public EmissionInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing('vehicleInformation', 'emissionInspection');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function fuelType(): ?FuelType
    {
        return $this->inspection->vehicleInformation?->fuel_type;
    }

    #[Computed]
    public function calculatedResult(): ?InspectionResult
    {
        if (!$this->fuelType) {
            return null;
        }

        return app(EmissionInspectionCalculator::class)->calculate($this->fuelType, $this->form->data());
    }
    public function save(): void
    {
        $this->form->save($this->inspection);

        session()->flash('success', 'Emission inspection saved successfully.');

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
        @if ($this->calculatedResult)
            <flux:badge icon="{{ $this->calculatedResult->icon() }}" color="{{ $this->calculatedResult->color() }}">
                {{ $this->calculatedResult->label() }}
            </flux:badge>
        @endif

        @if ($this->inspection->vehicleInformation && $this->inspection->vehicleInformation->fuel_type !== FuelType::Ev)
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit"
                :disabled="$this->fuelType === FuelType::Ev || $this->inspection->vehicleInformation === null">
                Save Emission Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
