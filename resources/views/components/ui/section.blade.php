@props(['title', 'description' => null])

<div class="space-y-4">
    <div>
        <flux:heading size="lg">
            {{ $title }}
        </flux:heading>

        @if ($description)
            <flux:text>
                {{ $description }}
            </flux:text>
        @endif
    </div>

    {{ $slot }}
</div>
