<?php

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

new #[Title("Search Customer")] class extends Component {
    public string $search = "";
    public ?customer $selectedCustomer = null;
    public bool $showResults = false;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public string $vin = "";

    #[Computed]
    public function customers()
    {
        if (blank($this->search)) {
            return collect();
        }

        return Customer::query()
            ->where(function ($query) {
                $query
                    ->where("name", "like", "%{$this->search}%")
                    ->orWhere("mobile", "like", "%{$this->search}%")
                    ->orWhere("id_number", "like", "%{$this->search}%");
            })
            ->orderBy("name")
            ->limit(10)
            ->get();
    }
    public function selectCustomer(Customer $customer)
    {
        return $this->redirectRoute(
            "inspections.create",
            [
                "customer_id" => $customer->id,
                "inspection_type_id" => $this->inspection_type_id,
                "sales_representative_id" => $this->sales_representative_id,
                "vin" => $this->vin,
            ],
            navigate: true,
        );
    }
};

?>

<section class="w-full">
    <div class="space-y-6">
        <flux:heading size="xl"> Search Customer </flux:heading>

        <flux:input
            wire:model.live.debounce.300ms="search"
            label="Search"
            placeholder="Name, Mobile or ID Number"
        />
        @if ($this->customers->isNotEmpty())
            <flux:card class="mt-6">
                @foreach ($this->customers as $customer)
                    <div
                        class="flex items-center justify-between border-b py-3 last:border-0"
                    >
                        <div>
                            <div class="font-medium">{{ $customer->name }}</div>

                            <div class="text-sm text-zinc-500">
                                {{ $customer->mobile }}
                            </div>
                        </div>

                        <flux:button
                            variant="primary"
                            size="sm"
                            wire:click="selectCustomer({{ $customer->id }})"
                        >
                            Select
                        </flux:button>
                    </div>

                @endforeach
            </flux:card>

        @endif
    </div>
</section>
