@props([
    'registered' => 0,
    'inProgress' => 0,
    'pendingApproval' => 0,
    'reinspection' => 0,
    'approved' => 0,
])

<div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

    <div class="mb-6 flex items-center justify-between">

        <flux:heading size="lg">
            Inspection Status
        </flux:heading>

        <flux:icon name="clipboard-document-check" class="size-6 text-zinc-500" />

    </div>

    <div class="grid grid-cols-2 gap-4">

        <div class="rounded-lg bg-zinc-50 p-4 dark:bg-zinc-950/30">
            <div class="text-sm text-zinc-500 dark:text-zinc-400">Registered</div>
            <div class="mt-1 text-2xl font-bold">
                {{ number_format($registered) }}
            </div>
        </div>

        <div class="rounded-lg bg-blue-50 p-4 dark:bg-blue-950/30">
            <div class="text-sm text-blue-700 dark:text-blue-300">In Progress</div>
            <div class="mt-1 text-2xl font-bold text-blue-700 dark:text-blue-300">
                {{ number_format($inProgress) }}
            </div>
        </div>

        <div class="rounded-lg bg-amber-50 p-4 dark:bg-amber-950/30">
            <div class="text-sm text-amber-700 dark:text-amber-300">Pending Approval</div>
            <div class="mt-1 text-2xl font-bold text-amber-700 dark:text-amber-300">
                {{ number_format($pendingApproval) }}
            </div>
        </div>

        <div class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-900 dark:bg-red-950/30">
            <div class="text-sm text-red-700 dark:text-red-300">Reinspection</div>
            <div class="mt-1 text-2xl font-bold text-red-700 dark:text-red-300">
                {{ number_format($reinspection) }}
            </div>
        </div>

    </div>

    <div class="mt-4 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-900 dark:bg-green-950/30">

        <div class="text-sm font-medium text-green-700 dark:text-green-400">
            Approved
        </div>

        <div class="mt-1 text-3xl font-bold text-green-700 dark:text-green-300">
            {{ number_format($approved) }}
        </div>

    </div>

</div>
