<flux:card class="space-y-6">

    <flux:heading size="lg">
        Saber Information
    </flux:heading>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        <x-ui.display-field label="Request No" :value="$inspection->request_no" />

        <x-ui.display-field label="Request Date" :value="$inspection->request_date?->format('Y-m-d')" />

        <x-ui.display-field label="Import Country" :value="$inspection->importCountry?->name" />

    </div>

</flux:card>
