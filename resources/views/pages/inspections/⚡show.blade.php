<?php

use App\Models\Inspection;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Computed;

new #[Title('Inspection Details')] class extends Component {
    public Inspection $inspection;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing(['customer', 'inspectionType', 'branch', 'salesRepresentative', 'createdBy', 'customPort', 'importCountry']);
    }
    #[Computed]
    public function inspectionTypeCode(): string
    {
        return $this->inspection->inspectionType->code;
    }
};

?>

<section class="w-full">


    <div class="flex items-start justify-between">

        <div class="space-y-1">

            <flux:heading size="xl">
                Inspection {{ $inspection->inspection_no }}
            </flux:heading>

            <flux:text class="text-zinc-500">
                {{ $inspection->inspectionType->name }}
            </flux:text>

        </div>

        <div class="flex gap-2">

            <flux:button variant="outline">
                Print
            </flux:button>

            <flux:button variant="primary" :href="route('inspections.edit', $inspection)" wire:navigate>
                Edit
            </flux:button>

            <flux:button variant="ghost" :href="route('inspections.index')" wire:navigate>
                Back
            </flux:button>

        </div>

    </div>
    <x-inspection.show.common-information :inspection="$inspection" />
    @if ($this->inspectionTypeCode === 'IMP')
        <x-inspection.show.imported-vehicle-information :inspection="$inspection" />
    @endif

    @if (in_array($this->inspectionTypeCode, ['SBG', 'SBE', 'MTC']))
        <x-inspection.show.saber-information :inspection="$inspection" />
    @endif

    @if (in_array($this->inspectionTypeCode, ['MDL', 'MDH']))
        <x-inspection.show.modified-vehicle-information :inspection="$inspection" />
    @endif

    {{-- section for inspections links --}}
    <flux:card class=" space-y-6">
        {{-- link to inspections/{id}/vehicle-information --}}
        <flux:button variant="primary" :href="route('inspections.vehicle-information.edit', $inspection)" wire:navigate>
            Vehicle Information
        </flux:button>
    </flux:card>

</section>
