<flux:card class="py-12 mt-4">
    <div class="space-y-4 text-center">
        <flux:heading> No Inspections found </flux:heading>

        <flux:text class="text-zinc-500">
            Try changing your search or create a new Inspection.
        </flux:text>

        <flux:button :href="route('inspections.create')" wire:navigate>
            Create Inspection
        </flux:button>
    </div>
</flux:card>
