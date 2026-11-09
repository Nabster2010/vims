<?php

use App\Models\Inspection;
use App\Enums\FuelType;
use Livewire\Attributes\Computed;
use App\Enums\InspectionResult;
use Flux\Flux;
use App\Livewire\Forms\SideSlipInspectionForm;
use App\Services\SideSlipInspectionCalculator;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public Inspection $inspection;
    public SideSlipInspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);
        $this->inspection = $inspection->loadMissing('sideSlipInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        return app(SideSlipInspectionCalculator::class)->calculate($this->form->data());
    }
    #[Computed]
    public function limits(): array
    {
        $fuel = $this->inspection->vehicleInformation?->fuel_type?->value;

        return config('test-limits.sideSlip', []);
    }
    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);
        $this->form->save($this->inspection);
        Flux::toast(variant: 'success', text: 'Side Slip inspection saved successfully.');
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

                    <div>
                        <flux:input wire:model.live.debounce.500ms="form.value" type="text" label="Value (m/km)" />
                        <x-inspection.test-limit :limit="$this->limits['value'] ?? null" />
                    </div>
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
                Save Side Slip Inspection
            </flux:button>
        </div>

    </form>
    </section>
</x-ui.page>
