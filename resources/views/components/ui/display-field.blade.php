@props(['label', 'value' => null])

<div class="space-y-1">

    <flux:text class="text-sm text-zinc-500">
        {{ $label }}
    </flux:text>

    <flux:text class="font-medium">
        {{ $value ?: '-' }}
    </flux:text>

</div>
