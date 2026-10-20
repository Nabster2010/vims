<?php

use Livewire\Component;
use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Livewire\Forms\HeadLightInspectionForm;
use App\Services\HeadLightInspectionCalculator;

new class extends Component {
    public Inspection $inspection;
    public HeadLightInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing('headLightInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        return app(HeadLightInspectionCalculator::class)->calculate($this->form->data());
    }
    public function save(): void
    {
        $this->form->save($this->inspection);

        session()->flash('success', 'Headlight inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} Headlight inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <flux:card class="space-y-6">

                <flux:heading size="lg">
                    Headlight Measurements
                </flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <flux:input wire:model.live.debounce.500ms="form.left" type="text" label="Left (cd)" />

                    <flux:input wire:model.live.debounce.500ms="form.right" type="text" label="Right (cd)" />
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
                Save Headlight Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
