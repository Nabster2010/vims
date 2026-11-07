<flux:card class="space-y-6">
    <flux:heading size="lg">
        Powertrain
    </flux:heading>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <flux:select wire:model.live="form.air_intake" label="Air Intake">
            <option value="">Select Air Intake</option>
            @foreach ($this->airIntakes as $airIntake)
                <option value="{{ $airIntake->value }}">
                    {{ $airIntake->value }}
                </option>
            @endforeach
        </flux:select>
        <flux:select wire:model.live="form.drive_line" label="Drive Line">
            <option value="">Select Drive Line</option>
            @foreach ($this->driveLines as $driveLine)
                <option value="{{ $driveLine->value }}">
                    {{ $driveLine->value }}
                </option>
            @endforeach
        </flux:select>
        <flux:input wire:model="form.engine_displacement" type="number" label="Engine Displacement" />
        <flux:input wire:model="form.engine_power" type="number" label="Engine Power" />
        <flux:input wire:model="form.number_of_cylinders" type="number" label="Number Of Cylinders" />
    </div>
</flux:card>
