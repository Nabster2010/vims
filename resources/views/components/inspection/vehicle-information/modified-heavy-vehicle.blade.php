<flux:card class="space-y-6">

    <flux:heading size="xl">
        Modified Heavy Vehicle Information
    </flux:heading>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">


        <flux:input wire:model.blur="form.engine_no" label="Engine No" />
        <flux:input wire:model.blur="form.number_of_cylinders" type="text" label="Number Of Cylinders" />
        <flux:input wire:model.blur="form.engine_displacement" type="text" label="Engine Displacement" />
        <flux:select wire:model.live="form.category_id" label="Category">
            <option value="">Select Body Type</option>

            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:input wire:model.blur="form.gross_weight" type="text" label="Gross Weight" />

        <flux:input wire:model.blur="form.width" type="text" label="Width" />

        <flux:input wire:model.blur="form.height" type="text" label="Height" />

        <flux:input wire:model.blur="form.length" type="text" label="Length" />
        <flux:input wire:model.blur="form.number_of_axles" type="text" label="Number Of Axles" />
        <flux:input wire:model.blur="form.front_axle_weight" type="text" label="Front Axle Weight" />
        <flux:input wire:model.blur="form.rear_axle_weight" type="text" label="Rear Axle Weight" />



    </div>

</flux:card>
