<flux:card class="space-y-6">

    <flux:heading size="lg">
        Common Information
    </flux:heading>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <x-ui.display-field label="Inspection No" :value="$inspection->inspection_no" />
        <div>
            <flux:text class="text-zinc-500">Status</flux:text>
            <flux:badge :color="$inspection->status->badgeColor()">
                {{ $inspection->status->label() }}
            </flux:badge>
        </div>
        <div>
            <flux:text class="text-zinc-500">Final Result</flux:text>
            @if ($inspection->final_result)
                <flux:badge size="lg" :color="$inspection->final_result->color()">
                    {{ $inspection->final_result->label() }}
                </flux:badge>
            @else
                <flux:badge size="sm" color="gray">
                    Pending
                </flux:badge>
            @endif
        </div>
        <x-ui.display-field label="Customer" :value="$inspection->customer->name" />
        <x-ui.display-field label="VIN" :value="$inspection->vin" />
        <x-ui.display-field label="Branch" :value="$inspection->branch->name" />
        <x-ui.display-field label="Inspection Type" :value="$inspection->inspectionType->name" />
        <x-ui.display-field label="Payment Type" :value="$inspection->payment_type" />
        <x-ui.display-field label="Payment amount" :value="number_format($inspection->payment_amount, 2)" />
        <x-ui.display-field label="Registered At" :value="$inspection->registered_at->format('Y-m-d H:i')" />
    </div>

</flux:card>
