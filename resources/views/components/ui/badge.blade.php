@props([
    'color' => 'zinc',
])

@php
    $colors = [
        'green' => 'lime',
        'red' => 'red',
        'yellow' => 'amber',
        'blue' => 'blue',
        'gray' => 'zinc',
        'zinc' => 'zinc',
    ];

    $variant = $colors[$color] ?? 'zinc';
@endphp

<flux:badge :color="$variant">
    {{ $slot }}
</flux:badge>
