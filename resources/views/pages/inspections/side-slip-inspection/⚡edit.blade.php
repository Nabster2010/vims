<?php

use Livewire\Component;
use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Livewire\Forms\SideSlipInspectionForm;
use App\Services\SideSlipInspectionCalculator;

new class extends Component {
    public Inspection $inspection;
    public SideSlipInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing('sideSlipInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function calculatedResult(): ?InspectionResult
    {
        return app(SideSlipInspectionCalculator::class)->calculate($this->form->data());
    }
    public function save(): void
    {
        $this->form->save($this->inspection);

        session()->flash('success', 'Side Slip inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} Side Slip inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <flux:card class="space-y-6">

                <flux:heading size="lg">
                    Side Slip Measurements
                </flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <flux:input wire:model.live.debounce.500ms="form.value" type="text" label="Value (m/km)" />
                </div>

            </flux:card>
        @endif


        @if ($this->inspection->vehicleInformation)
            @if ($this->calculatedResult)
                <flux:badge icon="{{ $this->calculatedResult->icon() }}" color="{{ $this->calculatedResult->color() }}">
                    {{ $this->calculatedResult->label() }}
                </flux:badge>
            @endif
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit" :disabled="$this->inspection->vehicleInformation === null">
                Save Side Slip Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
