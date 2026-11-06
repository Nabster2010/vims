<?php

use App\Livewire\Forms\VehicleInformationForm;
use App\Models\Inspection;
use App\Models\Manufacturer;
use App\Models\ModelType;
use App\Models\Color;
use App\Models\Country;
use App\Models\Category;
use Livewire\Attributes\Computed;
use App\Enums\FuelType;
use App\Enums\GearboxType;
use App\Enums\DriveLine;
use App\Enums\BodyType;
use App\Enums\AirIntake;
use App\Enums\VehicleCondition;
use App\Enums\MotorcycleCategory;
use App\Enums\MotorcycleUse;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;
use App\Services\Inspection\VinDecoderService;
use App\Services\ToastService;
use Flux\Flux;

new class extends BasePage {
    public Inspection $inspection;
    public VehicleInformationForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);
        $this->inspection = $inspection->loadMissing('inspectionType');
        $this->form->fillFromInspection($inspection);
        if (!$this->form->model_year) {
            $this->form->model_year = app(VinDecoderService::class)->modelYear($inspection->vin);
        }
    }
    #[Computed]
    public function manufacturers()
    {
        return Manufacturer::active()->orderBy('name')->get();
    }

    #[Computed]
    public function modelTypes()
    {
        return ModelType::active()->when($this->form->manufacturer_id, fn($query) => $query->where('manufacturer_id', $this->form->manufacturer_id))->orderBy('name')->get();
    }

    #[Computed]
    public function colors()
    {
        return Color::active()->orderBy('name')->get();
    }
    #[Computed]
    public function countries()
    {
        return Country::active()->orderBy('name')->get();
    }
    #[Computed]
    public function fuelTypes()
    {
        return FuelType::cases();
    }
    #[Computed]
    public function motorcycleCategories()
    {
        return MotorcycleCategory::cases();
    }

    #[Computed]
    public function gearboxTypes()
    {
        return GearboxType::cases();
    }

    #[Computed]
    public function driveLines(): array
    {
        return DriveLine::cases();
    }

    #[Computed]
    public function Categories()
    {
        return Category::active()->orderBy('name')->get();
    }
    #[Computed]
    public function motorcycleUses(): array
    {
        return MotorcycleUse::cases();
    }

    #[Computed]
    public function airIntakes(): array
    {
        return AirIntake::cases();
    }

    #[Computed]
    public function vehicleConditions(): array
    {
        return VehicleCondition::cases();
    }
    // reset model type when manufacturer changes
    public function updatedFormManufacturerId(): void
    {
        $this->form->model_type_id = null;
    }

    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);
        $this->form->save($this->inspection);
        Flux::toast(variant: 'success', text: 'Vehicle information saved successfully.');
        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>
<section class="w-full">
    <flux:heading size="xl"> Inspection {{ $this->inspection->inspection_no }} vehicle information </flux:heading>
    <form class="mt-6 space-y-6" wire:submit="save">
        <x-inspection.vehicle-information.common-vehicle-information />
        @if ($this->inspection->inspectionType->code === 'IMP')
            <x-inspection.vehicle-information.imported-vehicle />
        @endif
        {{-- gasoline & diesel & hev --}}
        @if ($this->inspection->inspectionType->code === 'SBG')
            <x-inspection.vehicle-information.saber-gasoline-information />
        @endif

        {{-- @if ($this->inspection->inspectionType->code === 'SBP')
            <x-inspection.vehicle-information.saber-phev-information />
        @endif --}}
        {{-- ev --}}
        @if ($this->inspection->inspectionType->code === 'SBE')
            <x-inspection.vehicle-information.saber-ev-information />
        @endif
        {{-- Phev --}}
        @if ($this->inspection->inspectionType->code === 'SBH')
            <x-inspection.vehicle-information.saber-phev-information />
        @endif
        @if ($this->inspection->inspectionType->code === 'MDL')
            <x-inspection.vehicle-information.modified-light-vehicle />
        @endif
        @if ($this->inspection->inspectionType->code === 'MDH')
            <x-inspection.vehicle-information.modified-heavy-vehicle />
        @endif

        @if ($this->inspection->inspectionType->code === 'MTC')
            <x-inspection.vehicle-information.motorcycle-information />
        @endif
        @if ($this->inspection->inspectionType->code === 'TRL')
            <x-inspection.vehicle-information.trailer-information />
        @endif

        <flux:textarea wire:model.live="form.remarks" label="Remarks" />

        <div class="flex justify-end">
            <flux:button variant="primary" type="submit" :disabled="$this->inspection->is_locked">
                Save Vehicle Information </flux:button>
        </div>
    </form>
</section>
