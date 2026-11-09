@props([
    'limit' => null,
])

@if ($limit)
    <div class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
        Normal Range:
        <span class="font-medium">
            {{ $limit['min'] }}
            –
            {{ $limit['max'] }}
            {{ $limit['unit'] }}
        </span>
    </div>
@endif
