<?php

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Livewire\Pages\BasePage;
use Flux\Flux;

new class extends BasePage {
    public Category $category;

    public CategoryForm $form;

    public function mount(Category $category): void
    {
        $this->authorize('update', $category);

        $this->category = $category;

        $this->form->fillFromCategory($this->category);
    }

    public function save(): void
    {
        $this->form->save($this->category);

        Flux::toast(variant: 'success', text: 'Category updated successfully.');

        $this->redirectRoute('administration.categories.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Edit Category
    </flux:heading>

    <flux:subheading class="mt-1">
        Update vehicle category information.
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

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
