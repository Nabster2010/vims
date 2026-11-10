<section
    class="relative overflow-hidden border-b border-zinc-200 bg-gradient-to-b from-white to-zinc-100 dark:border-zinc-800 dark:from-zinc-950 dark:to-zinc-900">

    <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">

        <div class="mx-auto max-w-4xl text-center">
            <div class="mb-8 flex justify-center items-center gap-3">
                <img src="{{ asset('images/vims-logo.png') }}" alt="VIMS" class="h-20 w-auto" />
            </div>

            <h1 class="text-5xl font-black tracking-tight sm:text-6xl lg:text-7xl">
                Vehicle Inspection
                <span class="block text-blue-600">
                    Management System
                </span>
            </h1>

            <p class="mx-auto mt-8 max-w-3xl text-lg leading-8 text-zinc-600 dark:text-zinc-400">

                Professional inspection platform for imported vehicles,
                Saber certification, modified vehicles, motorcycles,
                digital reports and branch operations.

            </p>

            <div class="mt-12 flex flex-wrap justify-center gap-4">

                <flux:button variant="primary" :href="route('dashboard.index')" wire:navigate>

                    Dashboard

                </flux:button>

                <flux:button variant="filled" href="#modules">

                    Explore Modules

                </flux:button>

            </div>

        </div>

    </div>

</section>
