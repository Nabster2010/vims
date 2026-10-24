<?php

use App\Livewire\Forms\ColorForm;
use App\Livewire\Pages\BasePage;
use App\Models\Color;
use App\Services\ToastService;

new class extends BasePage {
    public ColorForm $form;

    public function save(): void
    {
        $this->authorize('create', Color::class);

        $color = $this->form->create();

        ToastService::success('Color created successfully.');

        $this->redirectRoute('administration.colors.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create Color
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new Color.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Color Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.colors.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
