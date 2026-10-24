<?php

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public CategoryForm $form;

    public function mount(): void
    {
        $this->authorize('create', Category::class);
    }

    public function save(): void
    {
        $category = $this->form->create();

        ToastService::success('Category created successfully.');

        $this->redirectRoute('administration.categories.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create Category
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new vehicle category.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Category Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.categories.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
