<?php

use Livewire\Component;
use App\Models\SalesRepresentative;
use App\Models\InspectionType;
use Livewire\Attributes\Computed;

new class extends Component {
    public string $vin = "";
    public string $inspection_type = "";
    public string $salesRepresentative = "";
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
    protected function rules(): array
    {
        return [
            "inspection_type" => ["required"],
            "vin" => ["required", "string", "min:17", "max:17"],
            "salesRepresentative" => ["required"],
        ];
    }
    public function createInspection(): void
    {
        $this->validate();
        $this->readyToCreate = true;
    }
};
?>

<section class="w-full">
    <flux:heading size="xl"> Create Inspection </flux:heading>

    <form class="mt-6 space-y-6">
        <flux:select wire:model.live="inspection_type" label="Inspection Type">
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

                <flux:text> No customer selected. </flux:text>
            </div>

            <flux:button variant="primary"> Select Customer </flux:button>
        </flux:card>
        <flux:select
            wire:model.live="salesRepresentative"
            label="Sales Representative"
        >
            <option value="">Select sales representative</option>

            @foreach ($this->salesRepresentatives as $representative)
                <option value="{{ $representative->id }}">
                    {{ $representative->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:input wire:model.live="vin" label="VIN" />

        <div class="flex justify-end">
            <flux:button variant="primary" wire:click="createInspection">
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
