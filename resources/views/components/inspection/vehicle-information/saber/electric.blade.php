<flux:card class="space-y-6">

    <flux:heading size="lg">
        Electric Vehicle Information
    </flux:heading>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        <flux:input wire:model="form.electric_motor_power" type="text" label="Electric Motor Power" />

        <flux:input wire:model="form.battery_type" label="Battery Type" />

        <flux:input wire:model="form.battery_capacity" type="text" label="Battery Capacity" />

        <flux:input wire:model="form.battery_voltage" type="text" label="Battery Voltage" />

        <flux:input wire:model="form.battery_charge_time" type="text" label="Battery Charge Time" />

        <flux:input wire:model="form.electric_consumption" type="text" label="Electric Consumption" />


    </div>

</flux:card>
