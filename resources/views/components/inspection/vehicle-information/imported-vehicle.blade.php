<flux:card class="space-y-6">

    <flux:heading size="xl">
        Imported Vehicle
    </flux:heading>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        <flux:select wire:model.live="form.category_id" label="Category">
            <option value="">Select Body Type</option>

            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>


        <flux:select wire:model.live="form.vehicle_condition" label="Vehicle Condition">
            <option value="">Select Vehicle Condition</option>

            @foreach ($this->vehicleConditions as $condition)
                <option value="{{ $condition->value }}">
                    {{ $condition->value }}
                </option>
            @endforeach
        </flux:select>
        <flux:input wire:model.blur="form.number_of_cylinders" type="text" label="Number Of Cylinders" />
        <flux:input wire:model.blur="form.engine_displacement" type="text" label="Engine Displacement" />
        <flux:select wire:model.live="form.fuel_economy_compliance" label="Fuel Economy Compliance">
            <option value="">Select</option>

            @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                <option value="{{ $status->value }}">
                    {{ $status->label() }}
                </option>
            @endforeach
        </flux:select>
        <flux:select wire:model.live="form.vehicle_age_compliance" label="Vehicle Age Compliance">
            <option value="">Select</option>

            @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                <option value="{{ $status->value }}">
                    {{ $status->label() }}
                </option>
            @endforeach
        </flux:select>
    </div>


</flux:card>
