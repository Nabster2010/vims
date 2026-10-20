<?php

use Livewire\Component;
use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Livewire\Forms\SuspensionInspectionForm;
use App\Services\SuspensionInspectionCalculator;

new class extends Component {
    public Inspection $inspection;
    public SuspensionInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing('suspensionInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        return app(SuspensionInspectionCalculator::class)->calculate($this->form->data());
    }
    public function save(): void
    {
        $this->form->save($this->inspection);

        session()->flash('success', 'Suspension inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} Suspension inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <flux:card class="space-y-6">

                <flux:heading size="lg">
                    Suspension Measurements
                </flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    <flux:input wire:model.live.debounce.500ms="form.front_left" type="text" label="Front Left (%)" />
                    <flux:input wire:model.live.debounce.500ms="form.front_right" type="text"
                        label="Front Right (%)" />
                    <flux:input wire:model.live.debounce.500ms="form.rear_left" type="text" label="Rear Left (%)" />
                    <flux:input wire:model.live.debounce.500ms="form.rear_right" type="text"
                        label="Rear Right (%)" />
                </div>

            </flux:card>
        @endif


        @if ($this->inspection->vehicleInformation)
            @if ($this->calculatedResult)
                <flux:badge icon="{{ $this->calculatedResult['result']->icon() }}"
                    color="{{ $this->calculatedResult['result']->color() }}">
                    {{ $this->calculatedResult['result']->label() }}
                </flux:badge>
            @endif
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit" :disabled="$this->inspection->vehicleInformation === null">
                Save Suspension Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
