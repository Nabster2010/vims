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

        <div class="rounded-lg bg-zinc-50 p-4 dark:bg-zinc-800/50">
            <div class="text-sm text-zinc-500">Registered</div>
            <div class="mt-1 text-2xl font-bold">
                {{ number_format($registered) }}
            </div>
        </div>

        <div class="rounded-lg bg-zinc-50 p-4 dark:bg-zinc-800/50">
            <div class="text-sm text-zinc-500">In Progress</div>
            <div class="mt-1 text-2xl font-bold">
                {{ number_format($inProgress) }}
            </div>
        </div>

        <div class="rounded-lg bg-zinc-50 p-4 dark:bg-zinc-800/50">
            <div class="text-sm text-zinc-500">Pending Approval</div>
            <div class="mt-1 text-2xl font-bold">
                {{ number_format($pendingApproval) }}
            </div>
        </div>

        <div class="rounded-lg bg-zinc-50 p-4 dark:bg-zinc-800/50">
            <div class="text-sm text-zinc-500">Reinspection</div>
            <div class="mt-1 text-2xl font-bold">
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
