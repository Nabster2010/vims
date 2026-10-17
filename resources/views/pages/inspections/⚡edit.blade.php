<?php

use App\Livewire\Forms\InspectionForm;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomPort;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\SalesRepresentative;
use App\Services\InspectionService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Edit Inspection')] class extends Component {
    public Inspection $inspection;

    public InspectionForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection;
        $this->form->fillFromModel($inspection);
    }

    public function updated(string $property): void
    {
        if ($property === 'form.inspection_type_id') {
            $this->form->resetTypeFields();
        }
    }

    public function updateInspection(InspectionService $inspectionService): void
    {
        $this->form->validate();

        $inspectionService->update($this->inspection, $this->form->data());

        session()->flash('success', 'Inspection updated successfully.');

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
            <flux:button variant="primary" type="submit">
                Save Inspection
            </flux:button>
        </div>
    </form>
</section>
