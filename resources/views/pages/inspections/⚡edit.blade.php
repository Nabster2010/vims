<?php

use App\Livewire\Forms\InspectionForm;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomPort;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\SalesRepresentative;
use App\Services\InspectionService;
use App\Services\Inspection\InspectionLockService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;
use App\Services\Inspection\InspectionResetService;

new #[Title('Edit Inspection')] class extends BasePage {
    public Inspection $inspection;
    public InspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('update', $inspection);
        $this->inspection = $inspection;
        $this->form->fillFromModel($inspection);
    }

    //reset type fields when inspection type is changed
    public function updated(string $property): void
    {
        if ($property === 'form.inspection_type_id') {
            $this->form->resetTypeFields();
        }
    }

    public function updateInspection(InspectionService $inspectionService): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);

        $this->form->validate();
        $old_inspection_type = $this->inspection->inspection_type_id;
        if ($old_inspection_type !== $this->form->inspection_type_id) {
            app(InspectionResetService::class)->reset($this->inspection);
        }

        $inspectionService->update($this->inspection, $this->form->data());

        ToastService::success('Inspection updated successfully.');

        $this->redirectRoute('inspections.index', navigate: true);
    }

    #[Computed]
    public function selectedCustomer(): ?Customer
    {
        if (!$this->form->customer_id) {
            return null;
        }
        return Customer::find($this->form->customer_id);
    }
    #[Computed]
    public function salesRepresentatives()
    {
        return SalesRepresentative::active()->orderBy('name')->get();
    }
    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::active()->orderBy('name')->get();
    }
    #[Computed]
    public function countries()
    {
        return Country::active()->orderBy('name')->get();
    }

    #[Computed]
    public function customPorts()
    {
        return CustomPort::active()->orderBy('name')->get();
    }
    #[Computed]
    public function inspectionTypeCode(): ?string
    {
        return InspectionType::active()->whereKey($this->form->inspection_type_id)->value('code');
    }
};

?>

<section class="w-full">
    <flux:heading size="xl"> Edit Inspection </flux:heading>

    <form class="mt-6 space-y-6" wire:submit="updateInspection">
        <x-inspection.create.common-information />

        @if ($this->inspectionTypeCode === 'IMP')
            <x-inspection.create.imported-vehicle />
        @endif

        @if (in_array($this->inspectionTypeCode, ['SBG', 'SBE', 'SBP', 'SBH', 'MTC']))
            <x-inspection.create.saber-cars-information />
        @endif

        @if (in_array($this->inspectionTypeCode, ['MDL', 'MDH']))
            <x-inspection.create.modified-vehicle />
        @endif

        <div class="flex justify-end">

            <flux:button variant="primary" type="submit" :disabled="$this->inspection->is_locked">
                Save Inspection
            </flux:button>
        </div>
    </form>
</section>
