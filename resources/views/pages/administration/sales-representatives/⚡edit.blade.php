<?php

use App\Livewire\Forms\SalesRepresentativeForm;
use App\Models\SalesRepresentative;
use App\Livewire\Pages\BasePage;
use Flux\Flux;

new class extends BasePage {
    public SalesRepresentative $salesRepresentative;

    public SalesRepresentativeForm $form;

    public function mount(SalesRepresentative $salesRepresentative): void
    {
        $this->authorize('update', $salesRepresentative);

        $this->salesRepresentative = $salesRepresentative;

        $this->form->fillFromSalesRepresentative($salesRepresentative);
    }

    public function save(): void
    {
        $this->form->save($this->salesRepresentative);

        Flux::toast(variant: 'success', text: 'Sales representative updated successfully.');

        $this->redirectRoute('administration.sales-representatives.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Edit Sales Representative
    </flux:heading>

    <flux:subheading class="mt-1">
        Update sales representative information.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Sales Representative Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.company_name" label="Company Name" />

                <flux:input type="tel" wire:model="form.mobile" label="Mobile" />

                <flux:input type="email" wire:model="form.email" label="Email" />

            </div>

            <flux:textarea wire:model="form.notes" label="Notes" rows="4" />

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.sales-representatives.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
