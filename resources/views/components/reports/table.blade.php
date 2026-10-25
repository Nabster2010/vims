@props([
    'headers' => [],
])

<div class="overflow-hidden rounded-lg border">

    <table class="min-w-full border-collapse">

        <thead class="bg-gray-100">

            <tr>

                @foreach ($headers as $header)
                    <th class="border-b px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide">

                        {{ $header }}

                    </th>
                @endforeach

            </tr>

        </thead>

        <tbody>

            {{ $slot }}

        </tbody>

    </table>

</div>
