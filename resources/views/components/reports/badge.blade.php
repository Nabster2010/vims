@props(['value'])

@php

    $class = match ($value) {
        'Pass' => 'bg-green-100 text-green-700',

        'Fail' => 'bg-red-100 text-red-700',

        default => 'bg-gray-100 text-gray-700',
    };

@endphp

<span class="rounded-full px-3 py-1 text-xs font-semibold {{ $class }}">

    {{ $value }}

</span>
