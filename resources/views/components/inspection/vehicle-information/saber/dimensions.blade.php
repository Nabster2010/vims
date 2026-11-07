<flux:card class="space-y-6">
    <flux:heading size="lg">
        Vehicle Dimensions & Weights
    </flux:heading>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <flux:input wire:model="form.number_of_axles" type="number" label="Number Of Axles" />
        <flux:input wire:model="form.front_axle_weight" type="number" label="Front Axle Weight" />
        <flux:input wire:model="form.rear_axle_weight" type="number" label="Rear Axle Weight" />
        <flux:input wire:model="form.gross_weight" type="number" label="Gross Weight" />
        <flux:input wire:model="form.curb_weight" type="number" label="Curb Weight" />
        <flux:input wire:model="form.load_weight" type="number" label="Load Weight" />
        <flux:input wire:model="form.wheelbase" type="number" label="Wheelbase" />
        <flux:input wire:model="form.front_track_width" type="number" label="Front Track Width" />
        <flux:input wire:model="form.rear_track_width" type="number" label="Rear Track Width" />
        <flux:input wire:model="form.width" type="number" label="Width" />
        <flux:input wire:model="form.height" type="number" label="Height" />
        <flux:input wire:model="form.length" type="number" label="Length" />
    </div>
</flux:card>
