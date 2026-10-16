<?php

use Livewire\Component;
use App\Models\InspectionType;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    public function delete(InspectionType $inspectionType): void
    {
        $inspectionType->delete();
        session()->flash('success', 'Inspection type deleted successfully.');
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

        <flux:button :href="route('administration.inspection-types.create')" wire:navigate variant="primary">
            New Inspection Type
        </flux:button>

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

                        <flux:button size="sm" variant="ghost"
                            :href="route(
                                'administration.inspection-types.edit',
                                $inspectionType
                            )"
                            wire:navigate>
                            Edit
                        </flux:button>

                    </flux:table.cell>

                </flux:table.row>
            @endforeach

        </flux:table.rows>

    </flux:table>

</x-ui.page>
