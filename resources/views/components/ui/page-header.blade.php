@props(['title', 'description' => null])

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <flux:heading size="xl">
            {{ $title }}
        </flux:heading>

        @if ($description)
            <flux:text class="mt-1 text-zinc-500">
                {{ $description }}
            </flux:text>
        @endif
    </div>

    @if (trim($slot))
        <div class="flex items-center gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
