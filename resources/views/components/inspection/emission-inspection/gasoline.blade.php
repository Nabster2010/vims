<flux:card class="space-y-6">

    <flux:heading size="lg">
        Emission Measurements
    </flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <flux:input wire:model.live.debounce.500ms="form.hc" type="text" label="HC (ppm)" />

            <x-inspection.test-limit :limit="$this->limits['hc'] ?? null" />
        </div>

        <div>
            <flux:input wire:model.live.debounce.500ms="form.co" type="text" label="CO (%)" />

            <x-inspection.test-limit :limit="$this->limits['co'] ?? null" />
        </div>

    </div>

</flux:card>
