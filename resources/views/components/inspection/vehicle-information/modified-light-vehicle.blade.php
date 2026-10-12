<flux:card class="space-y-6">

    <flux:heading size="xl">
        Modified Light Vehicle Information
    </flux:heading>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">




        <flux:input wire:model.live="form.engine_no" label="Engine No" />
        <flux:input wire:model.live="form.number_of_cylinders" type="number" label="Number Of Cylinders" />
        <flux:input wire:model.live="form.engine_displacement" type="number" label="Engine Displacement" />
        <flux:select wire:model.live="form.body_type" label="Body Type">
            <option value="">Select Body Type</option>

            @foreach ($this->bodyTypes as $bodyType)
                <option value="{{ $bodyType->value }}">
                    {{ $bodyType->value }}
                </option>
            @endforeach
        </flux:select>
        <flux:select wire:model.live="form.color_id" label="Color">
            <option value="">Select Color</option>
            @foreach ($this->colors as $color)
                <option value="{{ $color->id }}">
                    {{ $color->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:input wire:model.live="form.gross_weight" type="number" label="Gross Weight" />
        <flux:input wire:model.live="form.width" type="number" label="Width" />
        <flux:input wire:model.live="form.height" type="number" label="Height" />
        <flux:input wire:model.live="form.length" type="number" label="Length" />

    </div>

</flux:card>
