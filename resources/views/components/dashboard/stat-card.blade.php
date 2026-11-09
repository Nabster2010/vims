@props(['title', 'value' => 0, 'description' => null, 'icon' => 'chart-bar', 'color' => 'primary'])

@php
    $colors = [
        'primary' => [
            'bg' => 'bg-blue-100 dark:bg-blue-900/30',
            'text' => 'text-blue-600 dark:text-blue-400',
        ],

        'success' => [
            'bg' => 'bg-emerald-100 dark:bg-emerald-900/30',
            'text' => 'text-emerald-600 dark:text-emerald-400',
        ],

        'warning' => [
            'bg' => 'bg-amber-100 dark:bg-amber-900/30',
            'text' => 'text-amber-600 dark:text-amber-400',
        ],

        'danger' => [
            'bg' => 'bg-red-100 dark:bg-red-900/30',
            'text' => 'text-red-600 dark:text-red-400',
        ],

        'secondary' => [
            'bg' => 'bg-zinc-100 dark:bg-zinc-800',
            'text' => 'text-zinc-600 dark:text-zinc-300',
        ],
    ];

    $theme = $colors[$color] ?? $colors['primary'];
@endphp

<x-dashboard.dashboard-card>

    <div class="flex items-start justify-between">

        <div>

            <flux:text class="text-sm text-zinc-500">
                {{ $title }}
            </flux:text>

            <div class="mt-3 text-4xl font-bold tracking-tight">
                {{ number_format($value) }}
            </div>

            @if ($description)
                <flux:text class="mt-2 text-sm text-zinc-500">
                    {{ $description }}
                </flux:text>
            @endif

        </div>

        <div class="flex h-14 w-14 items-center justify-center rounded-2xl {{ $theme['bg'] }}">

            <flux:icon :name="$icon" class="h-7 w-7 {{ $theme['text'] }}" />

        </div>

    </div>

</x-dashboard.dashboard-card>
