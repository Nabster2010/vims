<?php

use App\Livewire\Forms\PhotoForm;
use App\Livewire\Pages\BasePage;
use App\Models\Inspection;
use App\Services\Inspection\InspectionLockService;
use App\Services\ToastService;
use Livewire\WithFileUploads;
use Flux\Flux;

new class extends BasePage {
    use WithFileUploads;

    public Inspection $inspection;

    public PhotoForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);

        $this->inspection = $inspection->loadMissing('photos');
        $this->form->fillFromInspection($inspection);
    }

    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);

        $this->form->save($this->inspection);

        Flux::toast(variant: 'success', text: 'Inspection photos saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $inspection->inspection_no }} Photos
    </flux:heading>

    <form wire:submit="save" class="mt-6 space-y-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Vehicle Photos
            </flux:heading>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

                <x-inspection.photo-upload field="front" title="Front View" required />
                <x-inspection.photo-upload field="rear" title="Rear View" required />
                <x-inspection.photo-upload field="left" title="Left Side" required />
                <x-inspection.photo-upload field="right" title="Right Side" required />
                <x-inspection.photo-upload field="vin" title="VIN Plate" required />
                <x-inspection.photo-upload field="dashboard" title="Dashboard" />
                <x-inspection.photo-upload field="engine" title="Engine" />
                <x-inspection.photo-upload field="odometer" title="Odometer" />
            </div>

        </flux:card>

        <div class="flex justify-end">

            <flux:button variant="primary" type="submit" :disabled="$inspection->is_locked">

                Save Photos

            </flux:button>

        </div>

    </form>

</x-ui.page>
