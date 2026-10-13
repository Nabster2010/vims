@props([
    'target' => null,
    'text' => 'Loading...',
])

<div wire:loading @if ($target) wire:target="{{ $target }}" @endif
    class="flex items-center justify-center gap-2 py-6 text-sm text-zinc-500">
    <flux:icon.loading class="size-5 animate-spin" />

    <span>{{ $text }}</span>
</div>
