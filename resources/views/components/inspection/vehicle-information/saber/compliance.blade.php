<flux:card class="space-y-6">

    <flux:heading size="lg">
        Compliance
    </flux:heading>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @if ($this->form->fuel_type === \App\Enums\FuelType::Ev)
            <flux:input wire:model.blur="form.equivalent_fuel_economy" type="text" label="Equivalent Fuel Economy " />
        @endif
        @if ($this->form->fuel_type !== \App\Enums\FuelType::Ev)
            <flux:input wire:model.live="form.fuel_economy" type="text" label="Fuel Economy" />
        @endif

        <flux:select wire:model.live="form.energy_efficiency_compliance" label="Energy Efficiency Compliance">
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

        <flux:select wire:model.live="form.fuel_economy_compliance" label="Fuel Economy Compliance">
            <option value="">Select</option>

            @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                <option value="{{ $status->value }}">
                    {{ $status->label() }}
                </option>
            @endforeach
        </flux:select>

        <flux:select wire:model.live="form.is_vehicle_rare" label="Is Vehicle Rare">
            <option value="">Select</option>

            @foreach (\App\Enums\ComplianceStatus::cases() as $status)
                <option value="{{ $status->value }}">
                    {{ $status->label() }}
                </option>
            @endforeach
        </flux:select>

    </div>

</flux:card>
