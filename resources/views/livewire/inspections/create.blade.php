<section class="w-full">

    <flux:heading size="xl">
        Create Inspection
    </flux:heading>

    <form class="mt-6 space-y-6">
        <flux:select
    wire:model.live="inspection_type"
    label="Inspection Type"
>
    <option value="">Select inspection type</option>

    <option value="imported_vehicle">
        Imported Vehicle
    </option>

    <option value="saber_gasoline">
        Saber Gasoline/Diesel
    </option>

    <option value="saber_ev">
        Saber EV / HEV
    </option>

    <option value="modified_light">
        Modified Vehicle (< 3500 kg)
    </option>

    <option value="modified_heavy">
        Modified Vehicle (> 3500 kg)
    </option>

    <option value="motorcycle">
        Motorcycle
    </option>
</flux:select>
<flux:card class="space-y-4">

    <div>
        <flux:heading>
            Customer
        </flux:heading>

        <flux:text>
            No customer selected.
        </flux:text>
    </div>

    <flux:button variant="primary">

        Select Customer

    </flux:button>

</flux:card>

        <flux:input
            wire:model.live="vin"
            label="VIN"
        />

    </form>

</section>
