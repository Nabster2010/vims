<?php

use Livewire\Component;
use App\Models\InspectionType;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Livewire\Pages\BasePage;

new class extends BasePage {
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', InspectionType::class);
    }

    #[Computed]
    public function inspectionTypes()
    {
        return InspectionType::query()

            ->withCount('visualItems')

            ->orderBy('name')

            ->paginate(10);
    }
};
?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <flux:heading size="xl">
            Inspection Types
        </flux:heading>

        @can('create', InspectionType::class)
            <flux:button :href="route('administration.inspection-types.create')" wire:navigate variant="primary">
                New Inspection Type
            </flux:button>
        @endcan

    </div>

    <flux:table class="mt-6">

        <flux:table.columns>
            <flux:table.column>Code</flux:table.column>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Arabic Name</flux:table.column>
            <flux:table.column>Visual Items</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>

        <flux:table.rows>

            @foreach ($this->inspectionTypes as $inspectionType)
                <flux:table.row>

                    <flux:table.cell>
                        {{ $inspectionType->code }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $inspectionType->name }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $inspectionType->name_ar }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $inspectionType->visual_items_count }}
                    </flux:table.cell>

                    <flux:table.cell>

                        @if ($inspectionType->is_active)
                            <flux:badge color="green">
                                Active
                            </flux:badge>
                        @else
                            <flux:badge color="zinc">
                                Inactive
                            </flux:badge>
                        @endif

                    </flux:table.cell>

                    <flux:table.cell align="end">
                        @can('update', $inspectionType)
                            <flux:button size="sm" variant="ghost"
                                :href="route(
                                    'administration.inspection-types.edit',
                                    $inspectionType
                                )"
                                wire:navigate>
                                Edit
                            </flux:button>
                        @endcan

                    </flux:table.cell>

                </flux:table.row>
            @endforeach

        </flux:table.rows>

    </flux:table>

</x-ui.page>
