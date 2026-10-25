@props(['label', 'value'])

<div>

    <div class="text-xs uppercase tracking-wide text-gray-500">

        {{ $label }}

    </div>

    <div class="font-medium">

        {{ $value ?: '-' }}

    </div>

</div>
