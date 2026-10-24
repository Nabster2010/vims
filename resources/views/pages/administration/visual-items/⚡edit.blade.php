<?php

use App\Livewire\Forms\VisualItemForm;
use App\Models\VisualItem;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public VisualItem $visualItem;

    public VisualItemForm $form;

    public function mount(VisualItem $visualItem): void
    {
        $this->authorize('update', $visualItem);

        $this->visualItem = $visualItem;

        $this->form->fillFromVisualItem($this->visualItem);
    }

    public function save(): void
    {
        $this->form->save($this->visualItem);

        ToastService::success('Visual item updated successfully.');

        $this->redirectRoute('administration.visual-items.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Edit Visual Item
    </flux:heading>

    <flux:subheading class="mt-1">
        Update visual inspection item information.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Visual Item Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

                <flux:input wire:model="form.code" label="Code" required />

                <flux:input wire:model="form.sort_order" type="number" label="Sort Order" />

                <flux:input wire:model="form.category" label="Category" />

                <flux:input wire:model="form.category_ar" label="Arabic Category" />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.visual-items.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
