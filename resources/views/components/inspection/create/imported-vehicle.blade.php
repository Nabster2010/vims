<flux:card class="space-y-6">
    <flux:heading size="lg">Imported Vehicle</flux:heading>

    <div class="grid gap-4 md:grid-cols-2">
        <flux:input wire:model.live.debounce.500ms="form.request_no" label="Request No" />

        <flux:input wire:model.live.debounce.500ms="form.request_date" type="date" label="Request Date" />

        <flux:input wire:model.live.debounce.500ms="form.custom_declaration_no" label="Custom Declaration No" />

        <flux:field>
            <flux:label>Customz Clearance Date</flux:label>
            <flux:input.group>
                <flux:input wire:model.live.debounce.500ms="form.custom_declaration_date" type="date" />
                <flux:input.group.suffix>
                    {{ $this->form->custom_declaration_date ? app(\App\Services\DateService::class)->hijri($this->form->custom_declaration_date) : 'N/A' }}
                </flux:input.group.suffix>
            </flux:input.group>
        </flux:field>

        <flux:select wire:model.live="form.custom_port_id" label="Custom Port">
            <option value="">Select Custom Port</option>

            @foreach ($this->customPorts as $port)
                <option value="{{ $port->id }}">
                    {{ $port->name }} — {{ $port->name_ar }} ({{ $port->code }})
                </option>
            @endforeach
        </flux:select>
    </div>
</flux:card>
