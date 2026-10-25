<?php

use App\Livewire\Forms\CustomerForm;
use Livewire\Attributes\Title;
use App\Enums\CustomerType;
use App\Models\Customer;
use App\Enums\IdentityType;
use Livewire\Attributes\Url;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;

new #[Title('Create Customer')] class extends BasePage {
    public CustomerForm $form;
    #[Url]
    public ?int $inspection_id = null;
    #[Url]
    public ?string $return_to = null;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public ?string $vin = null;
    #[Url]
    public ?string $request_date = null;
    #[Url]
    public ?string $custom_declaration_date = null;
    #[Url]
    public ?string $request_no = null;
    #[Url]
    public ?string $custom_declaration_no = null;
    #[Url]
    public ?int $custom_port_id = null;
    #[Url]
    public ?int $import_country_id = null;
    #[Url]
    public ?string $plate_no = null;
    #[Url]
    public ?string $modification_center = null;
    #[Url]
    public ?string $current_type = null;
    #[Url]
    public ?string $target_type = null;
    #[Url]
    public ?int $owner_id = null;

    public function mount(): void
    {
        $this->authorize('create', Customer::class);
    }

    public function save()
    {
        $data = $this->form->validate();
        $customer = Customer::create($data);
        ToastService::success('Customer created successfully.');

        $parameters = [
            'customer_id' => $customer->id,
            'inspection_type_id' => $this->inspection_type_id,
            'sales_representative_id' => $this->sales_representative_id,
            'vin' => $this->vin,
            'request_date' => $this->request_date,
            'custom_declaration_date' => $this->custom_declaration_date,
            'request_no' => $this->request_no,
            'custom_declaration_no' => $this->custom_declaration_no,
            'custom_port_id' => $this->custom_port_id,
            'import_country_id' => $this->import_country_id,
            'plate_no' => $this->plate_no,
            'modification_center' => $this->modification_center,
            'current_type' => $this->current_type,
            'target_type' => $this->target_type,
            'owner_id' => $this->owner_id,
        ];

        if ($this->return_to === 'inspections.create') {
            return $this->redirectRoute('inspections.create', $parameters, navigate: true);
        }

        if ($this->return_to === 'inspections.edit') {
            $parameters['inspection'] = $this->inspection_id;
            return $this->redirectRoute('inspections.edit', $parameters, navigate: true);
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
