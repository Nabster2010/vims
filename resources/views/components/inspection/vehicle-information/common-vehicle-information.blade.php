<flux:card class="space-y-6">
    <flux:heading size="xl">
        Common Vehicle Information
    </flux:heading>
    <flux:input wire:model.live="form.inspection_date" label="Inspection Date" type="date" />
    <flux:select wire:model.live="form.manufacturer_id" label="Manufacturer">
        <option value="">Select Manufacturer</option>
        @foreach ($this->manufacturers as $manufacturer)
            <option value="{{ $manufacturer->id }}">
                {{ $manufacturer->name }}
            </option>
        @endforeach
    </flux:select>
    <flux:select wire:model.live="form.model_type_id" label="Model Type">
        <option value="">Select Model Type</option>
        @foreach ($this->modelTypes as $modelType)
            <option value="{{ $modelType->id }}">
                {{ $modelType->name }}
            </option>
        @endforeach
    </flux:select>
    <flux:input wire:model.live="form.model_year" type="number" label="Model Year" />
    <flux:select wire:model.live="form.fuel_type" label="Fuel Type">
        <option value="">Select Fuel Type</option>
        @foreach ($this->fuelTypes as $fuelType)
            <option value="{{ $fuelType->value }}">
                {{ $fuelType->value }}
            </option>
        @endforeach
    </flux:select>

    <flux:select wire:model.live="form.gearbox_type" label="Gearbox Type">
        <option value="">Select Gearbox Type</option>

        @foreach ($this->gearboxTypes as $gearboxType)
            <option value="{{ $gearboxType->value }}">
                {{ $gearboxType->value }}
            </option>
        @endforeach
    </flux:select>
    <flux:select wire:model.live="form.origin_country_id" label="Origin Country">
        <option value="">Select Country</option>
        @foreach ($this->countries as $country)
            <option value="{{ $country->id }}">
                {{ $country->name }}
            </option>
        @endforeach
    </flux:select>

    <flux:input wire:model.live="form.mileage" label="Mileage" />
    <flux:input wire:model.live="form.number_of_seats" type="number" label="Number Of Seats" />

</flux:card>
