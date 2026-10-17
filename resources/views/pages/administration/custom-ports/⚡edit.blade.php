<?php

use App\Livewire\Forms\CustomPortForm;
use App\Models\CustomPort;
use Livewire\Component;

new class extends Component {
    public CustomPort $customPort;

    public CustomPortForm $form;

    public function mount(CustomPort $customPort): void
    {
        $this->customPort = $customPort;

        $this->form->fillFromCustomPort($customPort);
    }

    public function save(): void
    {
        $this->form->save($this->customPort);

        session()->flash('success', 'Custom port updated successfully.');

        $this->redirectRoute('administration.custom-ports.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">

        Edit Custom Port

    </flux:heading>

    <flux:subheading class="mt-1">

        Update custom port information.

    </flux:subheading>

    <form wire:submit="save" class="mt-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">

                Custom Port Information

            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.name_ar" label="Arabic Name" required />

                <flux:input wire:model="form.code" label="Code" required />

            </div>

            <flux:checkbox wire:model="form.is_active" label="Active" />

        </flux:card>

        <div class="mt-6 flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('administration.custom-ports.index')" wire:navigate>

                Cancel

            </flux:button>

            <flux:button variant="primary" type="submit">

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
