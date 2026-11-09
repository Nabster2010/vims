<?php

use App\Models\Inspection;
use App\Models\Branch;
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
    public string $status = '';

    #[Url]
    public ?string $branchId = null;

    #[Url]
    public ?string $fromDate = null;

    #[Url]
    public ?string $toDate = null;

    #[Url]
    public string $sort = 'registered_at';

    #[Url]
    public string $direction = 'desc';

    #[Url]
    public ?int $inspectionTypeId = null;

    #[Url]
    public ?string $finalResult = null;

    public bool $showAdvancedFilters = false;

    public function mount(): void
    {
        $this->authorize('viewAny', Inspection::class);
    }

    #[Computed]
    public function filteredQuery()
    {
        //using local Scope in Inspection Model
        return Inspection::query()
            ->with(['customer', 'inspectionType', 'branch', 'inspector', 'vehicleInformation.manufacturer', 'vehicleInformation.modelType'])

            ->when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))

            ->when($this->branchId, fn($q) => $q->where('branch_id', $this->branchId))

            ->when($this->fromDate, fn($q) => $q->whereDate('registered_at', '>=', $this->fromDate))

            ->when($this->toDate, fn($q) => $q->whereDate('registered_at', '<=', $this->toDate))
            ->when($this->finalResult, fn($q) => $q->where('final_result', $this->finalResult))
            ->search($this->search)
            ->filterStatus($this->status)
            ->filterInspectionTypeId($this->inspectionTypeId);
    }

    #[Computed]
    public function inspections()
    {
        return $this->filteredQuery()->orderBy($this->sort, $this->direction)->paginate(10);
    }

    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::query()->where('is_active', true)->orderBy('name')->get();
    }
    #[Computed]
    public function branches()
    {
        return Branch::orderBy('name')->get();
    }
    #[Computed]
    public function users()
    {
        return User::query()->orderBy('name')->get();
    }

    public function updated(string $property): void
    {
        if (in_array($property, ['search', 'status', 'inspectionTypeId', 'branchId', 'fromDate', 'toDate', 'finalResult', 'createdBy'])) {
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
    }
    public function resetFilters(): void
    {
        $this->reset('search', 'status', 'inspectionTypeId', 'branchId', 'fromDate', 'toDate', 'finalResult', 'createdBy');

        $this->sort = 'registered_at';
        $this->direction = 'desc';

        $this->resetPage();
    }
    public function exportCsv()
    {
        $filename = 'inspections_' . now()->format('Ymd_His') . '.csv';

        $columns = [
            'Inspection No' => fn($i) => $i->report_no,
            'Registered At' => fn($i) => optional($i->registered_at)->format('Y-m-d'),
            'Request No' => fn($i) => $i->request_no,
            'Customer' => fn($i) => data_get($i, 'customer.name'),
            'VIN' => fn($i) => $i->vin,
            'Model Year' => fn($i) => data_get($i, 'vehicleInformation.model_year'),
            'Mileage' => fn($i) => data_get($i, 'vehicleInformation.mileage'),
            'Manufacturer' => fn($i) => data_get($i, 'vehicleInformation.manufacturer.name'),
            'Model Type' => fn($i) => data_get($i, 'vehicleInformation.modelType.name'),
            'Inspection Type' => fn($i) => data_get($i, 'inspectionType.name'),
            'Branch' => fn($i) => data_get($i, 'branch.name'),
            'Inspector' => fn($i) => data_get($i, 'inspector.name'),
            'Status' => fn($i) => $i->status?->label(),
            'Final Result' => fn($i) => $i->final_result?->label(),
        ];

        return response()->streamDownload(function () use ($columns) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM لدعم العربية في Excel
            fwrite($handle, "\xEF\xBB\xBF");

            // رؤوس الأعمدة
            fputcsv($handle, array_keys($columns));

            foreach ($this->filteredQuery()->orderBy($this->sort, $this->direction)->cursor() as $inspection) {
                fputcsv($handle, array_map(fn($callback) => $callback($inspection), $columns));
            }
            fclose($handle);
        }, $filename);
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
                                @can('update', $inspection)
                                    <flux:button size="sm" variant="outline"
                                        :href="route('inspections.edit', $inspection)" wire:navigate>
                                        Edit
                                    </flux:button>
                                @endcan

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
