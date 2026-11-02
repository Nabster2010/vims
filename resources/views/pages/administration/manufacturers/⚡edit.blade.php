<?php

use App\Livewire\Forms\ManufacturerForm;
use App\Models\Manufacturer;
use Livewire\Component;
use App\Models\Country;
use Livewire\Attributes\Computed;
use App\Livewire\Pages\BasePage;
use Flux\Flux;

new class extends BasePage {
    public Manufacturer $manufacturer;

    public ManufacturerForm $form;

    public function mount(Manufacturer $manufacturer): void
    {
        $this->authorize('update', $manufacturer);
        $this->manufacturer = $manufacturer;

        $this->form->fillFromManufacturer($manufacturer);
    }

    #[Computed]
    public function countries()
    {
        return Country::active()->orderBy('name')->get();
    }

    public function save(): void
    {
        $this->form->save($this->manufacturer);

        Flux::toast(variant: 'success', text: 'Manufacturer updated successfully.');

        $this->redirectRoute('administration.manufacturers.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">

        Edit Manufacturer

    </flux:heading>

    <flux:subheading class="mt-1">

        Update manufacturer information.

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

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
