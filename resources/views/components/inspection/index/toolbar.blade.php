<div class="flex items-center justify-between">
    <div>
        <flux:heading size="xl"> Inspections </flux:heading>

        <flux:text class="mt-1 text-zinc-500">
            Manage vehicle inspections.
        </flux:text>
    </div>

    <flux:button variant="primary" :href="route('inspections.create')" wire:navigate>
        New Inspection
    </flux:button>
</div>
