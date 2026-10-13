<?php

use App\Livewire\Forms\CustomerForm;
use Livewire\Attributes\Title;
use App\Enums\CustomerType;
use App\Models\Customer;
use App\Enums\IdentityType;
use Livewire\Component;
use Livewire\Attributes\Url;

new #[Title('Create Customer')] class extends Component {
    public CustomerForm $form;
    #[Url]
    public ?string $return_to = null;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public ?string $vin = null;

    public function save()
    {
        $data = $this->form->validate();
        $customer = Customer::create($data);
        if ($this->return_to === 'inspections.create') {
            //if return_to is null redirect to customers.index else redirect to inspections.create
            if ($this->return_to === null) {
                return $this->redirectRoute('customers.index', navigate: true);
            }
            return $this->redirectRoute(
                'inspections.create',
                [
                    'customer_id' => $customer->id,
                    'inspection_type_id' => $this->inspection_type_id,
                    'sales_representative_id' => $this->sales_representative_id,
                    'vin' => $this->vin,
                ],
                navigate: true,
            );
        }

        return $this->redirectRoute('customers.index', navigate: true);
    }
};

?>

<x-ui.page>
    <flux:heading size="xl"> Create Customer </flux:heading>

    <form class="space-y-6" wire:submit="save">
        <flux:card class="space-y-6">
            <flux:heading> Customer Information </flux:heading>
            <flux:select wire:model.live="form.customer_type" label="Customer Type">
                @foreach (CustomerType::cases() as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->name }}
                    </option>
                @endforeach
            </flux:select>
            <flux:select wire:model.live="form.identity_type" label="Identity Type">
                @foreach (IdentityType::cases() as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->name }}
                    </option>
                @endforeach
            </flux:select>
            <flux:input wire:model.live="form.identity_number" label="Identity Number" />
            <flux:input wire:model.live="form.name" label="Customer Name" />
        </flux:card>
        <flux:card class="space-y-6">
            <flux:heading> Contact Information </flux:heading>

            <flux:input wire:model.live="form.mobile" label="Mobile" />
            <flux:input wire:model.live="form.email" type="email" label="Email" />

            <flux:textarea wire:model.live="form.address" label="Address" rows="3" />
        </flux:card>
        <flux:card class="space-y-6">
            <flux:heading> Business Information </flux:heading>

            <flux:input wire:model.live="form.vat_number" label="VAT Number" />
        </flux:card>
        <flux:card class="space-y-6">
            <flux:heading> Additional Information </flux:heading>

            <flux:textarea wire:model.live="form.notes" label="Notes" rows="4" />
        </flux:card>
        <x-ui.form-actions>
            <flux:button variant="ghost"
                :href="route('customers.search', ['inspection_type_id' => $this->inspection_type_id, 'sales_representative_id' => $this->sales_representative_id, 'vin' => $this->vin])"
                wire:navigate>
                Cancel
            </flux:button>

            <flux:button variant="primary" type="submit">
                {{ $this->return_to ? 'Create & Select Customer' : 'Save Customer' }}
            </flux:button>
        </x-ui.form-actions>
    </form>
</x-ui.page>
