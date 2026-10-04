<?php

use Livewire\Component;

new class extends Component {
    public string $vin = '';
    public string $inspection_type = '';
    public string $salesRepresentative = '';
    public bool $readyToCreate = false;
    protected function rules(): array
           {
        return [
            'inspection_type' => ['required'],
            'vin' => ['required', 'string', 'min:17', 'max:17'],
            'salesRepresentative' => ['required'],
            ];
           }
     public function createInspection(): void
            {
                $this->validate();
                $this->readyToCreate = true;
            }

};
?>

<section class="w-full">
    <flux:heading size="xl"> Create Inspection </flux:heading>

    <form class="mt-6 space-y-6">
        <flux:select wire:model.live="inspection_type" label="Inspection Type">
            <option value="">Select inspection type</option>

            <option value="imported_vehicle">Imported Vehicle</option>

            <option value="saber_gasoline">Saber Gasoline/Diesel</option>

            <option value="saber_ev">Saber EV / HEV</option>

            <option value="modified_light">Modified Vehicle (< 3500 kg)</option>

            <option value="modified_heavy">Modified Vehicle (> 3500 kg)</option>

            <option value="motorcycle">Motorcycle</option>
        </flux:select>
        <flux:card class="space-y-4">
            <div>
                <flux:heading> Customer </flux:heading>

                <flux:text> No customer selected. </flux:text>
            </div>

            <flux:button variant="primary"> Select Customer </flux:button>
        </flux:card>
        <flux:select
    wire:model.live="salesRepresentative"
    label="Sales Representative"
>
    <option value="">Select sales representative</option>

    <option value="1">Ahmed Trading</option>

    <option value="2">Al Rajhi</option>

    <option value="3">XYZ Motors</option>

</flux:select>

        <flux:input wire:model.live="vin" label="VIN" />

        <div class="flex justify-end">
            <flux:button variant="primary" wire:click="createInspection" >
                Create Inspection
            </flux:button>

        </div>
        @if ($readyToCreate)
            <flux:callout variant="success">
                Ready for database integration.
            </flux:callout>
        @endif
    </form>

</section>
