<?php

use App\Livewire\Forms\ManufacturerForm;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Country;
use App\Livewire\Pages\BasePage;
use App\Models\Manufacturer;
use Flux\Flux;

new class extends BasePage {
    public ManufacturerForm $form;

    public function mount(): void
    {
        $this->authorize('create', Manufacturer::class);
    }

    #[Computed]
    public function countries()
    {
        return Country::active()->orderBy('name')->get();
    }
    public function save(): void
    {
        $this->form->create();

        Flux::toast(variant: 'success', text: 'Manufacturer created successfully.');

        $this->redirectRoute('administration.manufacturers.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create Manufacturer
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new vehicle manufacturer.
    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Manufacturer Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />
                <flux:select wire:model="form.country_id" label="Country">

                    <option value="">
                        Select Country
                    </option>

                    @foreach ($this->countries as $country)
                        <option value="{{ $country->id }}">
                            {{ $country->name }}
                        </option>
                    @endforeach

                </flux:select>

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.manufacturers.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
