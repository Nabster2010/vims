<?php

use App\Models\Inspection;
use App\Models\InspectionType;
use App\Enums\UserRole;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Livewire\Pages\BasePage;

new #[Title('Inspections')] class extends BasePage {
    use WithPagination;
    #[Url]
    public string $search = '';

    #[Url]
    public string $sort = 'registered_at';

    #[Url]
    public string $direction = 'desc';

    #[Url]
    public ?int $inspectionTypeId = null;

    #[Url]
    public ?string $finalResult = null;

    public function mount(): void
    {
        $this->authorize('viewAny', Inspection::class);
    }

    #[Computed]
    public function reports()
    {
        //using local Scope in Inspection Model
        return Inspection::query()
            ->with(['customer', 'inspectionType', 'branch'])
            ->when(auth()->user()->role !== UserRole::SuperAdmin, fn($query) => $query->where('branch_id', auth()->user()->branch_id))
            ->when($this->finalResult, fn($q) => $q->where('final_result', $this->finalResult))
            ->where('status', 'Approved')
            ->where('final_result', '!=', 'Pending')
            ->search($this->search)
            ->filterInspectionTypeId($this->inspectionTypeId)
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::query()->where('is_active', true)->orderBy('name')->get();
    }
    public function updated(string $property): void
    {
        if (in_array($property, ['search', 'inspectionTypeId'])) {
            $this->resetPage();
        }
    }

    public function sortBy(string $column): void
    {
        if ($this->sort === $column) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $column;
            $this->direction = 'asc';
        }
        $this->resetPage();
    }
};

?>

<x-ui.page>
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl"> Reports </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Available Reports.
            </flux:text>
        </div>
    </div>
    <div class="mt-4 space-y-4">
        <div class="grid gap-4 md:grid-cols-12">

            <div class="md:col-span-7">
                <flux:input wire:model.live.debounce.300ms="search" placeholder="Inspection No, VIN, Customer..." />
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
            <div class="md:col-span-2">
                <flux:select wire:model.live="finalResult">

                    <option value="">All Results</option>
                    <option value="{{ App\Enums\InspectionResult::Pass }}">
                        Pass
                    </option>
                    <option value="{{ App\Enums\InspectionResult::Fail }}">
                        Fail
                    </option>


                </flux:select>
            </div>

        </div>
    </div>


    @if ($this->reports->count())
        <!-- Total Count -->
        <div class="mt-4 flex items-center justify-between">
            <flux:text class="text-zinc-500">
                Showing {{ $this->reports->total() }} inspections
            </flux:text>
        </div>
        <!-- Table -->
        <flux:table>

            <flux:table.columns>

                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('inspection_no')">
                    <div class="flex items-center gap-2">
                        <span>Inspection No</span>

                        @if ($sort === 'inspection_no')
                            <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </div>
                </flux:table.column>

                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('vin')">
                    <div class="flex items-center gap-2">
                        <span>VIN</span>

                        @if ($sort === 'vin')
                            <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </div>
                </flux:table.column>

                <flux:table.column>
                    Customer
                </flux:table.column>

                <flux:table.column>
                    Type
                </flux:table.column>

                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('status')">

                    <span>Result</span>

                </flux:table.column>

                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('registered_at')">
                    <div class="flex items-center gap-2">
                        <span>Registered At</span>

                        @if ($sort === 'registered_at')
                            <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </div>
                </flux:table.column>

                <flux:table.column>
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @foreach ($this->reports as $report)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $report->inspection_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $report->vin }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $report->customer->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $report->inspectionType->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge :color="$report->final_result->color()">
                                {{ $report->final_result }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $report->registered_at->format('Y-m-d') }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <div class="flex gap-2">
                                @can('printReport', $report)
                                    <flux:button size="sm" variant="outline" target="_blank"
                                        :href="route('reports.pdf', $report)" wire:navigate>
                                        Print
                                    </flux:button>
                                @endcan

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforeach

            </flux:table.rows>

        </flux:table>

        <div class="mt-6">
            {{ $this->reports->links() }}
        </div>
    @else
        <x-inspection.index.empty-state />
    @endif

</x-ui.page>
