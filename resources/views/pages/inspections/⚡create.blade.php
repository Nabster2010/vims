<?php

use Livewire\Component;
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

new #[Title("Create Inspection")] class extends Component {
    public InspectionForm $form;
    #[Url]
    public ?int $inspection_type_id = null;
    #[Url]
    public ?int $customer_id = null;
    #[Url]
    public ?int $sales_representative_id = null;
    #[Url]
    public string $vin = "";
    #[Url]
    public ?string $payment_type = "Card";
    #[Url]
    public ?float $payment_amount = 345.0;

    public function mount(): void
    {
        $this->form->fill([
            "customer_id" => $this->customer_id,
            "inspection_type_id" => $this->inspection_type_id,
            "sales_representative_id" => $this->sales_representative_id,
            "vin" => $this->vin,
            "payment_type" => $this->payment_type,
            "payment_amount" => $this->payment_amount,
        ]);
    }

    public function updated(string $property): void
    {
        if ($property !== "form.inspection_type_id") {
            return;
        }

        $this->form->fill([
            "request_no" => null,
            "request_date" => null,
            "custom_declaration_no" => null,
            "custom_declaration_date" => null,
            "custom_port_id" => null,
            "import_country_id" => null,
            "plate_no" => null,
            "modification_center" => null,
            "current_type" => null,
            "target_type" => null,
            "owner_id" => null,
        ]);
    }

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
    public function countries()
    {
        return Country::query()
            ->where("is_active", true)
            ->orderBy("name")
            ->get();
    }

    #[Computed]
    public function customPorts()
    {
        return CustomPort::query()
            ->where("is_active", true)
            ->orderBy("name")
            ->get();
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
        return InspectionType::query()
            ->whereKey($this->form->inspection_type_id)
            ->value("code");
    }
    public function createInspection(InspectionService $inspectionService): void
    {
        $this->form->validate();
        $data = [
            ...$this->form->all(),
            "branch_id" => Auth::user()->branch_id,
            "created_by" => Auth::id(),
        ];
        $inspectionService->create($data);
    }
};
?>

<section class="w-full">
    <flux:heading size="xl"> Create Inspection </flux:heading>

    <form class="mt-6 space-y-6" wire:submit="createInspection">
        <x-inspection.create.common-information />

        @if ($this->inspectionTypeCode === "IMP")
            <x-inspection.create.imported-vehicle />
        @endif

        @if (in_array($this->inspectionTypeCode, [ "SBG", "SBE", "MTC" ]))
            <x-inspection.create.saber-cars-information />
        @endif

        @if (in_array($this->inspectionTypeCode, ["MDL", "MDH"]))
            <x-inspection.create.modified-vehicle />
        @endif

        <div class="flex justify-end">
            <flux:button variant="primary" type="submit">
                Create Inspection
            </flux:button>
        </div>
    </form>
</section>
