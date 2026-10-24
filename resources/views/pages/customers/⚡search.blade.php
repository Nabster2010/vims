<?php

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Livewire\Pages\BasePage;

new #[Title('Search Customer')] class extends BasePage {
    public string $search = '';
    public ?Customer $selectedCustomer = null;
    #[Url]
    public ?int $inspection_id = null;
    public bool $showResults = false;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public string $vin = '';
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
    #[Url]
    public ?string $return_to = null;

    public function mount(): void
    {
        $this->authorize('viewAny', Customer::class);
    }

    #[Computed]
    public function customers()
    {
        if (blank($this->search)) {
            return collect();
        }

        return Customer::search($this->search)

            ->orderBy('name')

            ->limit(10)

            ->get();
    }
    public function selectCustomer(Customer $customer)
    {
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

        if ($this->return_to === 'inspections.edit') {
            $parameters['inspection'] = $this->inspection_id;
        }

        return $this->redirectRoute($this->return_to ?? 'inspections.create', $parameters, navigate: true);
    }

    public function getParametersProperty()
    {
        return [
            'inspection_id' => $this->inspection_id,
            'return_to' => $this->return_to,
            'inspection_type_id' => $this->inspection_type_id,
            'sales_representative_id' => $this->sales_representative_id,
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
    }
};

?>


<section class="w-full">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="xl"> Search Customer </flux:heading>

            <flux:button variant="primary" :href="route('customers.create', $this->getParametersProperty())"
                wire:navigate>
                Create Customer
            </flux:button>
        </div>

        <flux:input wire:model.live.debounce.300ms="search" label="Search" placeholder="Name, Mobile or ID Number" />
        @if ($this->customers->isNotEmpty())
            <flux:card class="mt-6">
                @foreach ($this->customers as $customer)
                    <div class="flex items-center justify-between border-b py-3 last:border-0">
                        <div>
                            <div class="font-medium">{{ $customer->name }}</div>

                            <div class="text-sm text-zinc-500">
                                {{ $customer->mobile }}
                            </div>
                        </div>

                        <flux:button variant="primary" size="sm" wire:click="selectCustomer({{ $customer->id }})">
                            Select
                        </flux:button>
                    </div>
                @endforeach
            </flux:card>

        @endif
    </div>
</section>
