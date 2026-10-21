@props([
    'result' => null,
    'failedItems' => [],
])

@if ($result)
    <div class="space-y-4">

        <flux:badge icon="{{ $result->icon() }}" color="{{ $result->color() }}" size="lg">

            {{ $result->label() }}

        </flux:badge>

        @if (!empty($failedItems))
            <flux:callout variant="danger" class="mt-4">

                <flux:heading size="sm">
                    Failed Items
                </flux:heading>

                <ul class="mt-2 list-disc list-inside space-y-1">

                    @foreach ($failedItems as $item)
                        <li>{{ $item }}</li>
                    @endforeach

                </ul>

            </flux:callout>
        @endif

    </div>
@endif
