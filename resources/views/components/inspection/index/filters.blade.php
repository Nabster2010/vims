    <div class="flex items-end gap-4 mt-4 ">
        <div class="flex-1">
            <flux:input wire:model.live.debounce.300ms="search"
                placeholder="Search inspection no, VIN or customer ...." />
        </div>

        <div class="w-48">
            <flux:select wire:model.live="status">
                <option value="">All Status</option>
                @foreach (App\Enums\InspectionStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach

            </flux:select>
        </div>

        <div class="w-56">
            <flux:select wire:model.live="inspectionTypeId">
                <option value="">All types</option>
                @foreach ($this->inspectionTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }} </option>
                @endforeach
            </flux:select>
        </div>
    </div>
