@props([
    'class' => '',
])

<div
    {{ $attributes->merge([
        'class' =>
            'rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm p-6 ' . $class,
    ]) }}>
    {{ $slot }}
</div>
