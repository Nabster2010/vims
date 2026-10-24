<?php

use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use App\Livewire\Forms\BrakeInspectionForm;
use App\Services\BrakeInspectionCalculator;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public Inspection $inspection;
    public BrakeInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);
        $this->inspection = $inspection->loadMissing('brakeInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        return app(BrakeInspectionCalculator::class)->calculate($this->form->data());
    }
    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);
        $this->form->save($this->inspection);
        ToastService::success('Brake inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} Brake inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <flux:card class="space-y-6">

                <flux:heading size="lg">
                    Brake Measurements
                </flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <flux:input wire:model.live.debounce.500ms="form.front" type="text" label="Front (%)" />
                    <flux:input wire:model.live.debounce.500ms="form.rear" type="text" label="Rear (%)" />
                    <flux:input wire:model.live.debounce.500ms="form.parking" type="text" label="Parking (%)" />
                </div>

            </flux:card>
        @endif


        @if ($this->inspection->vehicleInformation)
            <x-inspection.result-summary :result="$this->calculatedResult['result']" :failed-items="$this->calculatedResult['failedItems']" />
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit"
                :disabled="$this->inspection->vehicleInformation === null || $this->inspection->is_locked">
                Save Brake Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
