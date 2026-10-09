<flux:card class="space-y-6">

    <flux:heading size="lg">
        Imported Vehicle Information
    </flux:heading>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

        <div>
            <flux:text class="text-zinc-500">
                Request No
            </flux:text>

            <flux:text>
                {{ $inspection->request_no ?? '-' }}
            </flux:text>
        </div>

        <div>
            <flux:text class="text-zinc-500">
                Request Date
            </flux:text>

            <flux:text>
                {{ optional($inspection->request_date)->format('Y-m-d') ?? '-' }}
            </flux:text>
        </div>

        <div>
            <flux:text class="text-zinc-500">
                Custom Declaration No
            </flux:text>

            <flux:text>
                {{ $inspection->custom_declaration_no ?? '-' }}
            </flux:text>
        </div>

        <div>
            <flux:text class="text-zinc-500">
                Custom Declaration Date
            </flux:text>

            <flux:text>
                {{ optional($inspection->custom_declaration_date)->format('Y-m-d') ?? '-' }}
            </flux:text>
        </div>

        <div>
            <flux:text class="text-zinc-500">
                Custom Port
            </flux:text>

            <flux:text>
                {{ $inspection->customPort?->name ?? '-' }}
            </flux:text>
        </div>

    </div>

</flux:card>
