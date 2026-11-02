<?php

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Models\User;
use App\Livewire\Pages\BasePage;
use Flux\Flux;
use Livewire\Attributes\Computed;

new class extends BasePage {
    public Branch $branch;
    public BranchForm $form;

    public function mount(Branch $branch): void
    {
        $this->authorize('update', $branch);

        $this->branch = $branch;
        $this->form->fillFromBranch($branch);
    }

    #[Computed]
    public function managers()
    {
        return User::query()->orderBy('name')->get();
    }
    public function save(): void
    {
        $this->form->save($this->branch);

        Flux::toast(variant: 'success', text: 'Branch updated successfully.');

        $this->redirectRoute('administration.branches.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Edit Branch
    </flux:heading>

    <flux:subheading class="mt-1">
        Edit inspection branch.
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
