<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\VisualItem;

new class extends Component {
    use WithPagination;

    public string $search = '';

    #[Computed]
    public function visualItems()
    {
        return VisualItem::query()
            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('name_ar', 'like', "%{$this->search}%")
                        ->orWhere('code', 'like', "%{$this->search}%")
                        ->orWhere('category', 'like', "%{$this->search}%")
                        ->orWhere('category_ar', 'like', "%{$this->search}%");
                }),
            )
            ->orderBy('category')
            ->orderBy('sort_order')
            ->paginate(10);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">
                Visual Items
            </flux:heading>

            <flux:subheading>
                Manage visual inspection items.
            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.visual-items.create')" wire:navigate>

            New Visual Item

        </flux:button>

    </div>

    <div class="mt-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search visual items..." />
    </div>

    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>Name</flux:table.column>

                <flux:table.column>Category</flux:table.column>

                <flux:table.column>Code</flux:table.column>

                <flux:table.column>Sort</flux:table.column>

                <flux:table.column class="w-32">
                    Status
                </flux:table.column>

                <flux:table.column class="w-32 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($this->visualItems as $visualItem)
                    <flux:table.row>

                        <flux:table.cell>{{ $visualItem->name }}</flux:table.cell>

                        <flux:table.cell>{{ $visualItem->category }}</flux:table.cell>

                        <flux:table.cell>{{ $visualItem->code }}</flux:table.cell>

                        <flux:table.cell>{{ $visualItem->sort_order }}</flux:table.cell>

                        <flux:table.cell>

                            <flux:badge color="{{ $visualItem->is_active ? 'green' : 'red' }}">
                                {{ $visualItem->is_active ? 'Active' : 'Inactive' }}
                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell class="text-right">

                            <flux:button size="sm" variant="ghost"
                                :href="route('administration.visual-items.edit', $visualItem)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            <div class="py-8 text-center text-zinc-500">
                                No visual items found.
                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

        <div class="mt-6">
            {{ $this->visualItems->links() }}
        </div>

    </flux:card>

</x-ui.page>
