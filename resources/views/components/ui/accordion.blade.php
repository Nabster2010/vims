@props(['title', 'count' => null, 'defaultOpen' => false])

<div x-data="{ open: @js($defaultOpen) }"
    class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">

    <button type="button" @click="open = !open"
        class="flex w-full items-center justify-between bg-slate-50 px-5 py-4 transition hover:bg-slate-100 dark:bg-zinc-800 dark:hover:bg-zinc-700">

        <div class="flex items-center gap-3">

            <h3 class="text-sm font-semibold uppercase tracking-wide">
                {{ $title }}
            </h3>

            @if ($count)
                <span
                    class="rounded-full bg-slate-200 px-2 py-1 text-xs font-medium text-slate-700 dark:bg-zinc-700 dark:text-zinc-200">

                    {{ $count }} Items

                </span>
            @endif

        </div>

        <flux:icon.chevron-down class="h-5 w-5 transition-transform duration-200"
            x-bind:class="{ 'rotate-180': open }" />

    </button>

    <div x-show="open" x-collapse x-cloak>

        <div class="border-t border-slate-200 p-5 dark:border-zinc-700">

            {{ $slot }}

        </div>

    </div>

</div>
