<?php

use App\Models\Inspection;
use App\Models\CustomPort;
use App\Enums\PaymentType;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Forms\ImportedVehicleRegistrationForm;
use App\Services\ImportedVehicleRegistrationService;
use Livewire\Attributes\Computed;

new #[Title("Registration Information")] class extends Component {
    public Inspection $inspection;
    public ImportedVehicleRegistrationForm $form;

    public function save(ImportedVehicleRegistrationService $service): void
    {
        $data = $this->form->validate();
        $service->create($this->inspection, $data);
        session()->flash("success", "Registration Saved Successfully.");
    }

    #[Computed]
    public function customPorts()
    {
        return CustomPort::query()
            ->where("is_active", true)
            ->orderBy("name")
            ->get();
    }
    #[Computed]
    public function paymentTypes()
    {
        return PaymentType::cases();
    }
};

?>

<section class="w-full">
    <flux:heading size="xl"> Registration Information </flux:heading>

    <form wire:submit="save" class="mt-6 space-y-6">
        <flux:input wire:model.live="form.request_no" label="Request Number" />
        <flux:input
            type="date"
            wire:model.live="form.request_date"
            label="Request Date"
        />
        <flux:input
            wire:model.live="form.custom_declaration_no"
            label="Custom Declaration Number"
        />
        <flux:input
            type="date"
            wire:model.live="form.custom_declaration_date"
            label="Custom Declaration Date"
        />
        <flux:select wire:model.live="form.custom_port_id" label="Custom Port">
            <option value="">Select Custom Port</option>

            @foreach ($this->customPorts as $port)
                <option value="{{ $port->id }}">{{ $port->name }}</option>
            @endforeach
        </flux:select>
        <flux:select wire:model.live="form.payment_type" label="Payment Type">
            <option value="">Select Payment Type</option>

            @foreach ($this->paymentTypes as $paymentType)
                <option value="{{ $paymentType->value }}">
                    {{ $paymentType->label() }}
                </option>
            @endforeach
        </flux:select>
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                Save Registration
            </flux:button>
        </div>
    </form>
</section>
