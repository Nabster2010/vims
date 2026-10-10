<?php

use App\Models\Inspection;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Inspection Details')] class extends Component {
    public Inspection $inspection;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->load(['customer', 'inspectionType', 'branch', 'salesRepresentative', 'createdBy', 'customPort', 'importCountry']);
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
    @if ($inspection->inspectionType->code === 'IMP')
        <x-inspection.show.imported-vehicle-information :inspection="$inspection" />
    @endif

    @if (in_array($inspection->inspectionType->code, ['SBG', 'SBE', 'MTC']))
        <x-inspection.show.saber-information :inspection="$inspection" />
    @endif

    @if (in_array($inspection->inspectionType->code, ['MDL', 'MDH']))
        <x-inspection.show.modified-vehicle-information :inspection="$inspection" />
    @endif

</section>
