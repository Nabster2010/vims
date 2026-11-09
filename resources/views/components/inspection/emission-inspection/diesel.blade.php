<flux:card class="space-y-6">

    <flux:heading size="lg">
        Emission Test
    </flux:heading>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <flux:input wire:model.live.debounce.500ms="form.opacity" label="Opacity (%)" inputmode="decimal" />
            <x-inspection.test-limit :limit="$this->limits['opacity'] ?? null" />
        </div>
    </div>

</flux:card>
