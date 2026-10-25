@props(['title'])

<section class="mt-8">

    <h2 class="mb-4 border-b pb-2 text-lg font-semibold">

        {{ $title }}

    </h2>

    {{ $slot }}

</section>
