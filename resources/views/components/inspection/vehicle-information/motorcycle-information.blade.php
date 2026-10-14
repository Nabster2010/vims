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

        <flux:input wire:model.blur="form.maximum_speed" type="text" label="Maximum Speed" />

        <flux:input wire:model.blur="form.model_division" label="Model Division" />
        <flux:select wire:model.live="form.fuel_type" label="Fuel Type">
            <option value="">Select Fuel Type</option>
            @foreach ($this->fuelTypes as $fuelType)
                <option value="{{ $fuelType->value }}">
                    {{ $fuelType->value }}
                </option>
            @endforeach
        </flux:select>

        <flux:input wire:model.blur="form.manufacturing_year" type="text" label="Manufacturing Year" />
        <flux:input wire:model.blur="form.manufacturing_month" type="text" label="Manufacturing Month" />
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


        <flux:input wire:model.blur="form.engine_displacement" label="Engine Displacement" />

        <flux:input wire:model.blur="form.engine_power" label="Engine Power" />
        <flux:input wire:model.blur="form.engine_power_rpm" label="Engine Power at RPM" />

        <flux:input wire:model.blur="form.number_of_cylinders" label="Number Of Cylinders" />




        <flux:input wire:model.blur="form.gross_weight" type="text" label="Gross Weight" />
        <flux:input wire:model.blur="form.curb_weight" type="text" label="Curb Weight" />
        <flux:input wire:model.blur="form.load_weight" type="text" label="Load Weight" />
        <flux:input wire:model.blur="form.wheelbase" type="text" label="Wheelbase" />
        <flux:input wire:model.blur="form.width" type="text" label="Width" />
        <flux:input wire:model.blur="form.height" type="text" label="Height" />
        <flux:input wire:model.blur="form.length" type="text" label="Length" />
        <flux:input wire:model.blur="form.front_brake" label="Front Brake" />
        <flux:input wire:model.blur="form.rear_brake" label="Rear Brake" />
    </div>

</flux:card>
