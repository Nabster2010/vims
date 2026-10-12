<flux:card class="space-y-6">

    <flux:heading size="xl">
        Motorcycle Information
    </flux:heading>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <flux:select wire:model.live="form.motorcycle_use" label="Motorcycle Use">

            <option value="">Select Motorcycle Use</option>

            @foreach ($this->motorcycleUses as $use)
                <option value="{{ $use->value }}">
                    {{ $use->value }}
                </option>
            @endforeach

        </flux:select>

        <flux:input wire:model.live="form.maximum_speed" type="number" label="Maximum Speed" />

        <flux:input wire:model.live="form.model_division" label="Model Division" />
        <flux:select wire:model.live="form.fuel_type" label="Fuel Type">
            <option value="">Select Fuel Type</option>
            @foreach ($this->fuelTypes as $fuelType)
                <option value="{{ $fuelType->value }}">
                    {{ $fuelType->value }}
                </option>
            @endforeach
        </flux:select>

        <flux:input wire:model.live="form.manufacturing_year" type="number" label="Manufacturing Year" />
        <flux:input wire:model.live="form.manufacturing_month" type="number" label="Manufacturing Month" />
        <flux:select wire:model.live="form.shipment_country_id" label="Shipment Country">
            <option value="">Select Country</option>

            @foreach ($this->countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:select wire:model.live="form.production_country_id" label="Production Country">
            <option value="">Select Country</option>

            @foreach ($this->countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach
        </flux:select>


        <flux:input wire:model.live="form.engine_displacement" label="Engine Displacement" />

        <flux:input wire:model.live="form.engine_power" label="Engine Power" />
        <flux:input wire:model.live="form.engine_power_rpm" label="Engine Power at RPM" />

        <flux:input wire:model.live="form.number_of_cylinders" label="Number Of Cylinders" />




        <flux:input wire:model.live="form.gross_weight" type="number" label="Gross Weight" />
        <flux:input wire:model.live="form.curb_weight" type="number" label="Curb Weight" />
        <flux:input wire:model.live="form.load_weight" type="number" label="Load Weight" />


        <flux:input wire:model.live="form.wheelbase" type="number" label="Wheelbase" />

        <flux:input wire:model.live="form.width" type="number" label="Width" />

        <flux:input wire:model.live="form.height" type="number" label="Height" />

        <flux:input wire:model.live="form.length" type="number" label="Length" />
        <flux:input wire:model.live="form.front_brake" label="Front Brake" />
        <flux:input wire:model.live="form.rear_brake" label="Rear Brake" />
    </div>

</flux:card>
