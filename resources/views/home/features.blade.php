<section class="py-24">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="mb-16 text-center">

            <h2 class="text-4xl font-bold">
                Platform Features
            </h2>

            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                Everything you need to manage vehicle inspections from one place.
            </p>

        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @php
                $features = [
                    ['🚘', 'Multiple Inspection Types'],
                    ['🏢', 'Multi-Branch Management'],
                    ['👥', 'Role Based Access'],
                    ['📋', 'Digital Inspection Forms'],
                    ['📄', 'Professional PDF Reports'],
                    ['📱', 'QR Code Verification'],
                    ['📊', 'Real-time Dashboard'],
                    ['🔍', 'Advanced Search'],
                    ['🌙', 'Dark Mode Support'],
                ];
            @endphp

            @foreach ($features as [$icon, $title])
                <div
                    class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">

                    <div class="mb-4 text-4xl">
                        {{ $icon }}
                    </div>

                    <h3 class="text-xl font-semibold">
                        {{ $title }}
                    </h3>

                </div>
            @endforeach

        </div>

    </div>

</section>
