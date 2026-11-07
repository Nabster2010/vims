<flux:card class="space-y-6">
    <flux:heading size="lg">
        General Information
    </flux:heading>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <flux:input wire:model.live="form.model_division" label="Model Division" />
        <flux:input wire:model.live="form.manufacturing_year" type="number" label="Manufacturing Year" />
        <flux:input wire:model="form.number_of_doors" type="number" label="Number Of Doors" />
        <flux:select wire:model="form.category_id" label="Vehicle Category">
            <option value="">Select Category</option>
            @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:select wire:model="form.shipment_country_id" label="Shipment Country">
            <option value="">Select Country</option>
            @foreach ($this->countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach
        </flux:select>
        <flux:select wire:model="form.production_country_id" label="Production Country">
            <option value="">Select Country</option>
            @foreach ($this->countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach
        </flux:select>
    </div>
</flux:card>
