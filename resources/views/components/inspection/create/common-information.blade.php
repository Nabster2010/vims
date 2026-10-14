<flux:card class="space-y-6">
    <flux:heading size="xl"> Common Information </flux:heading>
    <flux:select wire:model.live="form.inspection_type_id" label="Inspection Type">
        <option value="">Select inspection type</option>
        @foreach ($this->inspectionTypes as $inspectionType)
            <option value="{{ $inspectionType->id }}">
                {{ $inspectionType->name }}
            </option>
        @endforeach
    </flux:select>
    <flux:card class="space-y-4">
        <div>
            <flux:heading> Customer </flux:heading>

            @if ($this->selectedCustomer)
                <div class="space-y-1">
                    <flux:heading class="size-sm">
                        Selected Customer
                    </flux:heading>
                    <flux:heading>
                        {{ $this->selectedCustomer->name }}
                    </flux:heading>

                    <flux:text>
                        {{ $this->selectedCustomer->mobile }}
                    </flux:text>

                    <flux:text>
                        {{ $this->selectedCustomer->id_number }}
                    </flux:text>
                    <flux:text class="text-zinc-500">
                        Customer ID: {{ $this->selectedCustomer->id }}
                    </flux:text>
                </div>
            @else
                <flux:text class="text-zinc-500">
                    No customer selected. Please select a customer.
                </flux:text>
            @endif
        </div>

        <flux:button variant="primary"
            :href="
                            route('customers.search', [
                    'inspection_type_id' => $this->form->inspection_type_id,
                    'sales_representative_id' => $this->form->sales_representative_id,
                    'vin' => $this->form->vin,
                    'payment_type' => $this->form->payment_type,
                    'payment_amount' => $this->form->payment_amount,
                ])
                        "
            wire:navigate>
            {{ $this->selectedCustomer ? 'Change Customer' : 'Select Customer' }}
        </flux:button>
        <flux:error name="form.customer_id" />
    </flux:card>
    <flux:select wire:model.live="form.sales_representative_id" label="Sales Representative">
        <option value="">Select sales representative</option>

        @foreach ($this->salesRepresentatives as $representative)
            <option value="{{ $representative->id }}">
                {{ $representative->name }}
            </option>
        @endforeach
    </flux:select>

    <flux:input wire:model.live.debounce.500ms="form.vin" label="VIN" />

    <flux:select wire:model.live="form.payment_type" label="Payment Type">
        <option value="">Select Payment Type</option>

        @foreach (\App\Enums\PaymentType::cases() as $paymentType)
            <option value="{{ $paymentType->value }}">
                {{ str($paymentType->name)->headline() }}
            </option>
        @endforeach
    </flux:select>

    <flux:input wire:model="form.payment_amount" label="Payment Amount" type="number" step="0.01" />
</flux:card>
