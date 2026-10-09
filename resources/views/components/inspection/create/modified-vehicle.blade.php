<flux:card class="space-y-6">
    <flux:heading size="lg"> Modified Vehicle </flux:heading>

    <flux:input wire:model.live="form.plate_no" label="Plate No" />

    <flux:input
        wire:model.live="form.modification_center"
        label="Modification Center"
    />

    <flux:input wire:model.live="form.current_type" label="Current Type" />

    <flux:input wire:model.live="form.target_type" label="Target Type" />

    <flux:input wire:model.live="form.owner_id" label="Owner ID" />
</flux:card>
