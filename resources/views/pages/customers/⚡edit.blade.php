<?php

use App\Livewire\Forms\CustomerForm;
use App\Enums\CustomerType;
use App\Enums\IdentityType;
use App\Models\Customer;
use Livewire\Attributes\Title;
use App\Livewire\Pages\BasePage;
use Flux\Flux;

new #[Title('Edit Customer')] class extends BasePage {
    public Customer $customer;

    public CustomerForm $form;

    public function mount(Customer $customer): void
    {
        $this->authorize('update', $customer);

        $this->customer = $customer;

        $this->form->fillFromModel($customer);
    }

    public function save()
    {
        $data = $this->form->validate();
        $this->customer->update($data);
        Flux::toast(variant: 'success', text: 'Customer updated successfully.');

        return $this->redirectRoute('customers.index', navigate: true);
    }
};
?>

<section class="w-full">
    <flux:heading size="xl"> Edit Customer </flux:heading>

    <form class="mt-6 space-y-6" wire:submit="save">
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
            <flux:input wire:model.live="form.name" label="CustomerName" />
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
        <div class="flex justify-end gap-3">
            <flux:button variant="ghost" :href="route('customers.index')" wire:navigate>
                Cancel
            </flux:button>

            <flux:button variant="primary" type="submit">
                Save Customer
            </flux:button>
        </div>
    </form>
</section>
