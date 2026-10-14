<flux:card class="space-y-6">

    <flux:heading size="lg">
        Emission Measurements
    </flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <flux:input wire:model.live.debounce.500ms="form.hc" type="text" label="HC (ppm)" />

        <flux:input wire:model.live.debounce.500ms="form.co" type="text" label="CO (%)" />

    </div>

</flux:card>
