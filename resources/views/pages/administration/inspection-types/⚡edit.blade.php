<?php

use App\Livewire\Forms\InspectionTypeForm;
use App\Models\InspectionType;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public InspectionType $inspectionType;
    public InspectionTypeForm $form;

    public function mount(InspectionType $inspectionType): void
    {
        $this->authorize('update', $inspectionType);
        $this->inspectionType = $inspectionType;
        $this->form->fillFromModel($inspectionType);
    }

    public function save(): void
    {
        $this->form->save();

        ToastService::success('Inspection type updated successfully.');

        $this->redirectRoute('administration.inspection-types.index', navigate: true);
    }
};
?>

<x-ui.page>
    <flux:heading size="xl">Edit Inspection Type</flux:heading>

    <form wire:submit="save" class="mt-6 space-y-6">
        <flux:card class="space-y-6">
            <flux:input wire:model="form.name" label="Name" />
            <flux:input wire:model="form.name_ar" label="Name (Arabic)" />
            <flux:input wire:model="form.prefix" label="Prefix" />
            <flux:input wire:model="form.code" label="Code" />
            <flux:textarea wire:model="form.description" label="Description" />
            <flux:switch wire:model="form.is_active" label="Active" />
        </flux:card>

        <div class="flex justify-end gap-4">
            <flux:button variant="ghost" :href="route('administration.inspection-types.index')" wire:navigate>
                Cancel
            </flux:button>
            <flux:button variant="primary" type="submit">
                Update Inspection Type
            </flux:button>
        </div>
    </form>
    <flux:card>
        <flux:button :href="route('administration.inspection-types.visual-items', $inspectionType)" wire:navigate>
            Visual Inspection Items
        </flux:button>
    </flux:card>

</x-ui.page>
