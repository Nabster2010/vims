<?php

use App\Models\Inspection;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Services\Inspection\InspectionModuleStatusService;
use App\Services\Inspection\InspectionFinalResultService;
use App\Enums\InspectionResult;

new #[Title('Inspection Details')] class extends Component {
    public Inspection $inspection;
    public array $moduleStatuses = [];

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection->loadMissing(['customer', 'inspectionType', 'branch', 'salesRepresentative', 'createdBy', 'customPort', 'importCountry']);
        $this->moduleStatuses = InspectionModuleStatusService::getStatuses($this->inspection);
    }
    #[Computed]
    public function inspectionTypeCode(): string
    {
        return $this->inspection->inspectionType->code;
    }
    #[Computed]
    public function inspectionResult(): array
    {
        return app(InspectionFinalResultService::class)->calculate($this->inspection);
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
    @if ($this->inspectionResult['result'] === InspectionResult::Fail)
        <x-inspection.show.results-summary :inspectionResult="$this->inspectionResult" />
    @endif



    <flux:card class="mt-4">
        <div class="space-y-6 grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <x-inspection.module-link :module="App\Enums\InspectionModule::VehicleInformation" :href="route('inspections.vehicle-information.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::EmissionInspection" :href="route('inspections.emission-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::HeadLightInspection" :href="route('inspections.head-light-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::SideSlipInspection" :href="route('inspections.side-slip-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::SuspensionInspection" :href="route('inspections.suspension-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::BrakeInspection" :href="route('inspections.brake-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
            <x-inspection.module-link :module="App\Enums\InspectionModule::VisualInspection" :href="route('inspections.visual-inspection.edit', $inspection)" :moduleStatuses="$moduleStatuses" />
        </div>
    </flux:card>

</section>
