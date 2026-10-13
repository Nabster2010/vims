<?php

use Livewire\Component;
use App\Models\Inspection;
use App\Models\InspectionType;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

new #[Title('Inspections')] class extends Component {
    use WithPagination;
    #[Url]
    public string $search = '';

    #[Url]
    public string $status = '';

    #[Url]
    public string $sort = 'registered_at';

    #[Url]
    public string $direction = 'desc';

    #[Url]
    public ?int $inspectionTypeId = null;

    #[Computed]
    public function inspections()
    {
        //using local Scope in Inspection Model
        return Inspection::query()
            ->with(['customer', 'inspectionType', 'branch'])
            ->search($this->search)
            ->filterStatus($this->status)
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
        if (in_array($property, ['search', 'status', 'inspectionTypeId'])) {
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
    <x-inspection.index.toolbar />
    <x-inspection.index.filters />
    @if ($this->inspections->count())
        <!-- Total Count -->
        <div class="mt-4 flex items-center justify-between">
            <flux:text class="text-zinc-500">
                Showing {{ $this->inspections->total() }} inspections
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
                    <div class="flex items-center gap-2">
                        <span>Status</span>
                        @if ($sort === 'status')
                            <span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </div>
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

                @foreach ($this->inspections as $inspection)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $inspection->inspection_no }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $inspection->vin }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $inspection->customer->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $inspection->inspectionType->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:badge :color="$inspection->status->badgeColor()">
                                {{ $inspection->status->label() }}
                            </flux:badge>
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $inspection->registered_at->format('Y-m-d') }}
                        </flux:table.cell>

                        <flux:table.cell>

                            <div class="flex gap-2">

                                <flux:button size="sm" variant="primary"
                                    :href="route('inspections.show', $inspection)" wire:navigate>
                                    View
                                </flux:button>
                                <flux:button size="sm" variant="outline"
                                    :href="route('inspections.edit', $inspection)" wire:navigate>
                                    Edit
                                </flux:button>

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforeach

            </flux:table.rows>

        </flux:table>

        <div class="mt-6">
            {{ $this->inspections->links() }}
        </div>
    @else
        <x-inspection.index.empty-state />
    @endif
    <x-inspection.index.delete-modal />
</x-ui.page>
