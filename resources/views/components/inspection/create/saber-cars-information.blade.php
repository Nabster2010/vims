<flux:card class="space-y-6">
    <flux:heading size="lg">Saber Inspection</flux:heading>

    <flux:input wire:model.live.debounce.500ms="form.request_no" label="Request No" />

    <flux:input wire:model.live="form.request_date" type="date" label="Request Date" />

    <flux:select wire:model.live="form.import_country_id" label="Import Country">
        <option value="">Select Country</option>

        @foreach ($this->countries as $country)
            <option value="{{ $country->id }}">
                {{ $country->name }} — {{ $country->name_ar }}
            </option>
        @endforeach
    </flux:select>
</flux:card>
