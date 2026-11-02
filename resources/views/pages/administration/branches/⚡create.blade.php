<?php

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Models\User;
use App\Livewire\Pages\BasePage;
use Livewire\Attributes\Computed;
use Flux\Flux;

new class extends BasePage {
    public BranchForm $form;

    public function mount(): void
    {
        $this->authorize('create', Branch::class);
    }

    public function save(): void
    {
        $branch = $this->form->create();

        Flux::toast(variant: 'success', text: 'Branch created successfully.');

        $this->redirectRoute('administration.branches.edit', $branch, navigate: true);
    }

    #[Computed]
    public function managers()
    {
        return User::query()->orderBy('name')->get();
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create Branch
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new inspection branch.
    </flux:subheading>

    <form wire:submit="save" class="mt-6 space-y-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Branch Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

                <flux:input wire:model="form.code" label="Code" required />

                <flux:input wire:model="form.phone" label="Phone" />

                <flux:input wire:model="form.email" label="Email" type="email" />
                <flux:select wire:model="form.manager_id" label="Manager">

                    <option value="">
                        Select Manager
                    </option>

                    @foreach ($this->managers as $manager)
                        <option value="{{ $manager->id }}">
                            {{ $manager->name }}
                        </option>
                    @endforeach

                </flux:select>

                <flux:checkbox wire:model="form.is_active" label="Active" />

            </div>

            <flux:textarea wire:model="form.address" label="Address" />

        </flux:card>



        <div class="flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.branches.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
