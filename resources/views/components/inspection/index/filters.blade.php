<div class="mt-4 space-y-4">

    {{-- Row 1 --}}
    <div class="grid gap-4 md:grid-cols-12">

        <div class="md:col-span-5">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Inspection No, VIN, Customer..." />
        </div>

        <div class="md:col-span-2">
            <flux:select wire:model.live="status">
                <option value="">Status</option>

                @foreach (App\Enums\InspectionStatus::cases() as $status)
                    <option value="{{ $status->value }}">
                        {{ $status->label() }}
                    </option>
                @endforeach
            </flux:select>
        </div>

        <div class="md:col-span-3">
            <flux:select wire:model.live="inspectionTypeId">
                <option value="">Type</option>

                @foreach ($this->inspectionTypes as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->name }}
                    </option>
                @endforeach
            </flux:select>
        </div>

        <div class="md:col-span-2 flex gap-2">

            <flux:button class="flex-1" variant="ghost"
                :icon="$this->showAdvancedFilters ? 'chevron-up' : 'chevron-down'"
                wire:click="$toggle('showAdvancedFilters')">

                {{ $this->showAdvancedFilters ? 'Less' : 'More' }}

            </flux:button>

        </div>

    </div>

    {{-- Row 2 --}}
    {{-- Row 2 --}}
    @if ($this->showAdvancedFilters)
        <div class="mt-4 rounded-xl border border-zinc-200 p-4 dark:border-zinc-700">

            <div class="grid items-end gap-4 md:grid-cols-12">

                <div class="md:col-span-2">

                    <flux:select wire:model.live="branchId" label="Branch"
                        :disabled="auth()->user()->role !== \App\Enums\UserRole::SuperAdmin">
                        <option value="">All Branches</option>

                        @foreach ($this->branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </flux:select>

                </div>

                <div class="md:col-span-2">
                    <flux:input type="date" label="From" wire:model.live="fromDate" />
                </div>

                <div class="md:col-span-2">
                    <flux:input type="date" label="To" wire:model.live="toDate" />
                </div>

                <div class="md:col-span-2">
                    <flux:select wire:model.live="finalResult" label="Final Result">

                        <option value="">All Results</option>

                        @foreach (App\Enums\InspectionResult::cases() as $result)
                            <option value="{{ $result->value }}">
                                {{ $result->label() }}
                            </option>
                        @endforeach

                    </flux:select>
                </div>

                <div class="md:col-span-2">
                    <flux:button class="w-full" variant="primary" icon="arrow-down-tray" wire:click="exportCsv">
                        Export
                    </flux:button>
                </div>

                <div class="md:col-span-2">
                    <flux:button class="w-full" variant="ghost" icon="arrow-path" wire:click="resetFilters">
                        Reset
                    </flux:button>
                </div>

            </div>

        </div>
    @endif

</div>
