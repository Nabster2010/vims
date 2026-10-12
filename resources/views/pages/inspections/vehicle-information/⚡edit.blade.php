<?php

use App\Livewire\Forms\VehicleInformationForm;
use App\Models\Inspection;
use App\Models\Manufacturer;
use App\Models\ModelType;
use App\Models\Color;
use App\Models\Country;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Enums\FuelType;
use App\Enums\GearboxType;
use App\Enums\DriveLine;
use App\Enums\BodyType;
use App\Enums\AirIntake;
use App\Enums\VehicleCondition;
use App\Enums\MotorcycleUse;

new class extends Component {
    public Inspection $inspection;
    public VehicleInformationForm $form;

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection;
        $this->form->load($inspection);
    }
    #[Computed]
    public function getManufacturersProperty()
    {
        return Manufacturer::active()->orderBy('name')->get();
    }

    #[Computed]
    public function getModelTypesProperty()
    {
        return ModelType::active()->when($this->form->manufacturer_id, fn($query) => $query->where('manufacturer_id', $this->form->manufacturer_id))->orderBy('name')->get();
    }

    #[Computed]
    public function getColorsProperty()
    {
        return Color::active()->orderBy('name')->get();
    }
    #[Computed]
    public function getCountriesProperty()
    {
        return Country::orderBy('name')->get();
    }
    public function getFuelTypesProperty(): array
    {
        return FuelType::cases();
    }

    public function getGearboxTypesProperty(): array
    {
        return GearboxType::cases();
    }

    public function getDriveLinesProperty(): array
    {
        return DriveLine::cases();
    }

    public function getBodyTypesProperty(): array
    {
        return BodyType::cases();
    }
    public function getMotorcycleUsesProperty(): array
    {
        return MotorcycleUse::cases();
    }

    public function getAirIntakesProperty(): array
    {
        return AirIntake::cases();
    }

    public function getVehicleConditionsProperty(): array
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
        $this->form->save($this->inspection);

        session()->flash('success', 'Vehicle information saved successfully.');
    }
};
?>
<section class="w-full">
    <flux:heading size="xl"> Inspection {{ $this->inspection->id }} vehicle information </flux:heading>
    <form class="mt-6 space-y-6" wire:submit="save">
        <x-inspection.vehicle-information.common-vehicle-information />
        @if ($this->inspection->inspectionType->code === 'IMP')
            <x-inspection.vehicle-information.imported-vehicle />
        @endif

        @if ($this->inspection->inspectionType->code === 'SBG')
            <x-inspection.vehicle-information.saber-gasoline-information />
        @endif

        @if ($this->inspection->inspectionType->code === 'SBP')
            <x-inspection.vehicle-information.saber-phev-information />
        @endif

        @if ($this->inspection->inspectionType->code === 'SBE')
            <x-inspection.vehicle-information.saber-ev-information />
        @endif
        @if ($this->inspection->inspectionType->code === 'SBH')
            <x-inspection.vehicle-information.saber-hev-information />
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

        <flux:textarea wire:model.live="form.remarks" label="Remarks" />

        <div class="flex justify-end">
            <flux:button variant="primary" type="submit">
                Save Vehicle Information </flux:button>
        </div>
    </form>
</section>
