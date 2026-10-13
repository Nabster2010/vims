@props(['title', 'description'])

<flux:card>

    <div class="py-12 text-center space-y-3">

        <flux:heading>
            {{ $title }}
        </flux:heading>

        <flux:text>
            {{ $description }}
        </flux:text>

        {{ $slot }}

    </div>

</flux:card>
