<flux:card class="space-y-6">

    <flux:heading size="lg">
        Modified Vehicle Information
    </flux:heading>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        <x-ui.display-field label="Plate No" :value="$inspection->plate_no" />

        <x-ui.display-field label="Modification Center" :value="$inspection->modification_center" />

        <x-ui.display-field label="Current Type" :value="$inspection->current_type" />

        <x-ui.display-field label="Target Type" :value="$inspection->target_type" />

        <x-ui.display-field label="Owner ID" :value="$inspection->owner_id" />

    </div>

</flux:card>
