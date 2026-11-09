@props(['title', 'description' => null, 'icon' => 'plus', 'href' => '#', 'variant' => 'ghost'])

<x-dashboard.dashboard-card class="transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">

    <a href="{{ $href }}" wire:navigate class="flex items-start gap-4">

        <div
            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">

            <flux:icon :name="$icon" class="h-6 w-6" />

        </div>

        <div class="min-w-0 flex-1">

            <flux:heading size="sm">

                {{ $title }}

            </flux:heading>

            @if ($description)
                <flux:text class="mt-1 text-sm text-zinc-500">

                    {{ $description }}

                </flux:text>
            @endif

        </div>

        <flux:icon name="chevron-right" class="mt-1 h-5 w-5 text-zinc-400" />

    </a>

</x-dashboard.dashboard-card>
