<?php

use App\Livewire\Forms\ModelTypeForm;
use App\Models\Manufacturer;
use App\Models\ModelType;
use Livewire\Attributes\Computed;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new class extends BasePage {
    public ModelTypeForm $form;

    public function mount(): void
    {
        $this->authorize('create', ModelType::class);
    }

    #[Computed]
    public function manufacturers()
    {
        return Manufacturer::active()->orderBy('name')->get();
    }

    public function save(): void
    {
        $this->form->create();

        ToastService::success('Model type created successfully.');

        $this->redirectRoute('administration.model-types.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">

        Create Model Type

    </flux:heading>

    <flux:subheading class="mt-1">

        Add a new vehicle model type.

    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">

                Model Type Information

            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:select wire:model="form.manufacturer_id" label="Manufacturer" required>

                    <option value="">
                        Select Manufacturer
                    </option>

                    @foreach ($this->manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">

                            {{ $manufacturer->name }}

                        </option>
                    @endforeach

                </flux:select>

                <div></div>

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.model-types.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save

            </flux:button>

        </div>

    </form>

</x-ui.page>
