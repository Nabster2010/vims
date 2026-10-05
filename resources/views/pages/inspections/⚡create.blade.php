<?php

use Livewire\Component;
use App\Models\SalesRepresentative;
use App\Models\Customer;
use App\Models\InspectionType;
use App\Services\InspectionService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Livewire\Forms\InspectionForm;

new #[Title("Create Inspection")] class extends Component {
    public InspectionForm $form;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $customer_id = null;
    #[Url]
    public ?int $sales_representative_id = null;

    public bool $readyToCreate = false;

    #[Computed]
    public function salesRepresentatives()
    {
        return SalesRepresentative::query()
            ->where("is_active", true)
            ->orderBy("name")
            ->get();
    }
    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::query()
            ->where("is_active", true)
            ->orderBy("name")
            ->get();
    }
    #[Computed]
    public function selectedCustomer(): ?Customer
    {
        if (!$this->customer_id) {
            return null;
        }
        return Customer::query()->find($this->customer_id);
    }
    protected function rules(): array
    {
        return [
            "inspection_type_id" => ["required"],
            "sales_representative_id" => ["required"],
        ];
    }
    public function createInspection(InspectionService $inspectionService): void
    {
        $this->validate();
        $inspection = $inspectionService->create([
            "branch_id" => Auth::user()->branch_id,
            "inspection_type_id" => $this->form->inspection_type_id,
            "customer_id" => $this->customer_id,
            "sales_representative_id" => $this->sales_representative_id,
            "vin" => $this->form->vin,
            "created_by" => Auth::id(),
        ]);
    }
};
?>

<section class="w-full">
    <flux:heading size="xl"> Create Inspection </flux:heading>

    <form class="mt-6 space-y-6" wire:submit="createInspection">
        <flux:select
            wire:model.live="form.inspection_type_id"
            label="Inspection Type"
        >
            <option value="">Select inspection type</option>
            @foreach ($this->inspectionTypes as $inspectionType)
                <option value="{{ $inspectionType->id }}">
                    {{ $inspectionType->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:card class="space-y-4">
            <div>
                <flux:heading> Customer </flux:heading>

                @if ($this->selectedCustomer)
                    <div class="space-y-1">
                        <flux:heading class="size-sm">
                            Selected Customer
                        </flux:heading>
                        <flux:heading>
                            {{
                                $this->selectedCustomer
                                    ->name
                            }}
                        </flux:heading>

                        <flux:text>
                            {{
                                $this->selectedCustomer
                                    ->mobile
                            }}
                        </flux:text>

                        <flux:text>
                            {{
                                $this->selectedCustomer
                                    ->id_number
                            }}
                        </flux:text>
                        <flux:text class="text-zinc-500">
                            Customer ID: {{
                                $this->selectedCustomer
                                    ->id
                            }}
                        </flux:text>
                    </div>

                @else
                    <flux:text class="text-zinc-500">
                        No customer selected. Please select a customer.
                    </flux:text>

                @endif
            </div>

            <flux:button
                variant="primary"
                :href="
                    route('customers.search', [
        'inspection_type_id' => $this->inspection_type_id,
        'sales_representative_id' => $this->sales_representative_id,
        'vin' => $this->form->vin,
    ])
                "
                wire:navigate
            >
                {{
                    $this->selectedCustomer
                        ? "Change Customer"
                        : "Select Customer"
                }}
            </flux:button>
        </flux:card>
        <flux:select
            wire:model.live="sales_representative_id"
            label="Sales Representative"
        >
            <option value="">Select sales representative</option>

            @foreach ($this->salesRepresentatives as $representative)
                <option value="{{ $representative->id }}">
                    {{ $representative->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:input wire:model.live="form.vin" label="VIN" />

        <div class="flex justify-end">
            <flux:button variant="primary" type="submit">
                Create Inspection
            </flux:button>
        </div>
        @if ($readyToCreate)
            <flux:callout variant="success">
                Ready for database integration.
            </flux:callout>
        @endif
    </form>
</section>
