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
        $this->form->fill([
            'inspection_type_id' => $inspection->inspection_type_id,
            'customer_id' => $inspection->customer_id,
            'sales_representative_id' => $inspection->sales_representative_id,
            'vin' => $inspection->vin,
            'payment_type' => $inspection->payment_type,
            'payment_amount' => $inspection->payment_amount,

            'request_no' => $inspection->request_no,
            'request_date' => $inspection->request_date,
            'custom_declaration_no' => $inspection->custom_declaration_no,
            'custom_declaration_date' => $inspection->custom_declaration_date,
            'custom_port_id' => $inspection->custom_port_id,

            'import_country_id' => $inspection->import_country_id,

            'plate_no' => $inspection->plate_no,
            'modification_center' => $inspection->modification_center,
            'current_type' => $inspection->current_type,
            'target_type' => $inspection->target_type,
            'owner_id' => $inspection->owner_id,
        ]);
        $this->form->inspectionId = $inspection->id;
    }

    public function updated(string $property): void
    {
        if ($property !== 'form.inspection_type_id') {
            return;
        }

        $this->form->fill([
            'request_no' => null,
            'request_date' => null,
            'custom_declaration_no' => null,
            'custom_declaration_date' => null,
            'custom_port_id' => null,
            'import_country_id' => null,
            'plate_no' => null,
            'modification_center' => null,
            'current_type' => null,
            'target_type' => null,
            'owner_id' => null,
        ]);
    }

    public function updateInspection(InspectionService $inspectionService): void
    {
        $this->form->validate();
        $inspectionService->update($this->inspection, $this->form->all());
        session()->flash('success', 'Inspection Updated Successfully');
        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
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
        return SalesRepresentative::query()->where('is_active', true)->orderBy('name')->get();
    }
    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::query()->where('is_active', true)->orderBy('name')->get();
    }
    #[Computed]
    public function countries()
    {
        return Country::query()->where('is_active', true)->orderBy('name')->get();
    }

    #[Computed]
    public function customPorts()
    {
        return CustomPort::query()->where('is_active', true)->orderBy('name')->get();
    }
    #[Computed]
    public function inspectionTypeCode(): ?string
    {
        return InspectionType::query()->whereKey($this->form->inspection_type_id)->value('code');
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
