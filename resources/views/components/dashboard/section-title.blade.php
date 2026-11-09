@props(['title', 'description' => null])

<div class="flex items-end justify-between">

    <div>

        <flux:heading size="lg">

            {{ $title }}

        </flux:heading>

        @if ($description)
            <flux:text class="mt-1 text-zinc-500">

                {{ $description }}

            </flux:text>
        @endif

    </div>

    {{ $actions ?? '' }}

</div>
