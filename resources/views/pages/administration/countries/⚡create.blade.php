<?php

use App\Livewire\Forms\CountryForm;
use Livewire\Component;

new class extends Component {
    public CountryForm $form;

    public function save(): void
    {
        $this->form->create();

        session()->flash('success', 'Country created successfully.');

        $this->redirectRoute('administration.countries.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create Country
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new country.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Country Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

                <flux:input wire:model="form.iso2" label="ISO2" maxlength="2" required />

                <flux:input wire:model="form.iso3" label="ISO3" maxlength="3" required />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.countries.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
