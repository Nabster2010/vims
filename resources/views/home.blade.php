<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white text-zinc-900 antialiased dark:bg-zinc-950 dark:text-white">

    @include('home.hero')

    @include('home.stats')

    @include('home.modules')

    @include('home.workflow')

    @include('home.features')

    @include('home.footer')

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>

</html>
