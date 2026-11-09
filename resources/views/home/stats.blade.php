<section class="py-20 bg-zinc-50 dark:bg-zinc-900/50">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="mb-14 text-center">

            <h2 class="text-3xl font-bold">
                VIMS at a Glance
            </h2>

            <p class="mt-3 text-zinc-600 dark:text-zinc-400">
                Real-time insights across your vehicle inspection operations.
            </p>

        </div>

        <section class="mt-16">

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-5">
                <div
                    class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">

                    <div class="text-4xl font-black text-blue-600">
                        {{ number_format($stats['inspections']) }}
                    </div>

                    <div class="mt-3 text-lg font-semibold">
                        Inspections
                    </div>

                    <p class="mt-2 text-sm text-zinc-500">
                        Inspection centers connected to the system.
                    </p>

                </div>
                <div
                    class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">

                    <div class="text-4xl font-black text-emerald-600">
                        {{ number_format($stats['customers']) }}
                    </div>

                    <div class="mt-3 text-lg font-semibold">
                        Customers
                    </div>

                    <p class="mt-2 text-sm text-zinc-500">
                        Total customers in the system.
                    </p>

                </div>
                <div
                    class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">

                    <div class="text-4xl font-black text-amber-600">
                        {{ number_format($stats['users']) }}
                    </div>

                    <div class="mt-3 text-lg font-semibold">
                        Total Users
                    </div>

                    <p class="mt-2 text-sm text-zinc-500">
                        Total users in the system.
                    </p>

                </div>

                <div
                    class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">

                    <div class="text-4xl font-black text-violet-600">
                        {{ number_format($stats['branches']) }} </div>

                    <div class="mt-3 text-lg font-semibold">
                        Branches
                    </div>

                    <p class="mt-2 text-sm text-zinc-500">
                        Total branches in the system.
                    </p>

                </div>

                <div
                    class="rounded-3xl border border-zinc-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">

                    <div class="text-4xl font-black text-red-600">
                        {{ number_format($stats['inspectionTypes']) }} </div>

                    <div class="mt-3 text-lg font-semibold">
                        Inspection Types
                    </div>

                    <p class="mt-2 text-sm text-zinc-500">
                        Total inspection types in the system.
                    </p>

                </div>

            </div>

        </section>


    </div>

</section>
