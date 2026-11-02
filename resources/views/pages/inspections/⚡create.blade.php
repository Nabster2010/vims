<?php

use App\Models\SalesRepresentative;
use App\Models\Customer;
use App\Models\Country;
use App\Models\CustomPort;
use App\Models\InspectionType;
use App\Services\InspectionService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Livewire\Forms\InspectionForm;
use App\Livewire\Pages\BasePage;
use App\Models\Inspection;
use App\Services\ToastService;
use Flux\Flux;

new #[Title('Create Inspection')] class extends BasePage {
    public InspectionForm $form;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $customer_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public string $vin = '';
    #[Url]
    public ?string $payment_type = 'Card';
    #[Url]
    public ?float $payment_amount = 345.0;
    #[Url]
    public ?string $request_date = null;
    #[Url]
    public ?string $request_no = null;
    #[Url]
    public ?string $custom_declaration_date = null;
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

    public function mount(): void
    {
        $this->authorize('create', Inspection::class);
        $this->form->fill([
            'customer_id' => $this->customer_id,
            'inspection_type_id' => $this->inspection_type_id,
            'sales_representative_id' => $this->sales_representative_id,
            'vin' => $this->vin,
            'payment_type' => $this->payment_type,
            'payment_amount' => $this->payment_amount,
            'request_date' => $this->request_date,
            'request_no' => $this->request_no,
            'custom_declaration_date' => $this->custom_declaration_date,
            'custom_declaration_no' => $this->custom_declaration_no,
            'custom_port_id' => $this->custom_port_id,
            'import_country_id' => $this->import_country_id,
            'plate_no' => $this->plate_no,
            'modification_center' => $this->modification_center,
            'current_type' => $this->current_type,
            'target_type' => $this->target_type,
            'owner_id' => $this->owner_id,
        ]);
    }

    public function updated(string $property): void
    {
        if ($property !== 'form.inspection_type_id') {
            return;
        }

        $this->form->fill([
            'request_no' => null,
            'request_date' => today()->toDateString(),
            'custom_declaration_no' => null,
            'custom_declaration_date' => today()->toDateString(),
            'custom_port_id' => null,
            'import_country_id' => null,
            'plate_no' => null,
            'modification_center' => null,
            'current_type' => null,
            'target_type' => null,
            'owner_id' => null,
        ]);
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
    public function selectedCustomer(): ?Customer
    {
        if (!$this->form->customer_id) {
            return null;
        }

        return Customer::find($this->form->customer_id);
    }
    #[Computed]
    public function inspectionTypeCode(): ?string
    {
        return InspectionType::active()->whereKey($this->form->inspection_type_id)->value('code');
    }
    public function createInspection(InspectionService $inspectionService): void
    {
        $this->form->validate();
        $user = Auth::user();
        $data = [...$this->form->all(), 'branch_id' => $user->branch_id, 'created_by' => $user->id];
        $inspectionService->create($data);
        Flux::toast(variant: 'success', text: 'Inspection created successfully.');
        $this->redirectRoute('inspections.index', navigate: true);
    }
};
?>

<x-ui.page>
    <flux:heading size="xl"> Create Inspection </flux:heading>

    <form class="mt-6 space-y-6" wire:submit="createInspection">
        <x-inspection.create.common-information />

        @if ($this->inspectionTypeCode === 'IMP')
            <x-inspection.create.imported-vehicle />
        @endif

        @if (in_array($this->inspectionTypeCode, ['SBG', 'SBE', 'MTC', 'SBP', 'SBH']))
            <x-inspection.create.saber-cars-information />
        @endif

        @if (in_array($this->inspectionTypeCode, ['MDL', 'MDH']))
            <x-inspection.create.modified-vehicle />
        @endif
        @if ($this->inspectionTypeCode === 'TRL')
            <x-inspection.create.trailer />
        @endif

        <div class="flex justify-end">




            <flux:button variant="primary" type="submit">
                Create Inspection
            </flux:button>
        </div>
    </form>
</x-ui.page>
