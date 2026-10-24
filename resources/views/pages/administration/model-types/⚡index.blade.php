<?php

use App\Models\ModelType;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Livewire\Pages\BasePage;

new class extends BasePage {
    use WithPagination;

    public string $search = '';

    public function mount(): void
    {
        $this->authorize('viewAny', ModelType::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function modelTypes()
    {
        return ModelType::query()

            ->with('manufacturer')

            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('name_ar', 'like', "%{$this->search}%")
                        ->orWhereHas('manufacturer', fn($query) => $query->where('name', 'like', "%{$this->search}%"));
                }),
            )

            ->orderBy('manufacturer_id')
            ->orderBy('name')

            ->paginate(20);
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">

                Model Types

            </flux:heading>

            <flux:subheading>

                Manage vehicle model types.

            </flux:subheading>

        </div>
        @can('create', ModelType::class)
            <flux:button variant="primary" :href="route('administration.model-types.create')" wire:navigate>

                New Model Type

            </flux:button>
        @endcan

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search model types..." />

    </div>

    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    Manufacturer
                </flux:table.column>

                <flux:table.column>
                    Name
                </flux:table.column>

                <flux:table.column>
                    Arabic Name
                </flux:table.column>

                <flux:table.column class="w-28">
                    Status
                </flux:table.column>

                <flux:table.column class="w-24 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->modelTypes as $modelType)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $modelType->manufacturer->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $modelType->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $modelType->name_ar }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($modelType->is_active)
                                <flux:badge color="green">

                                    Active

                                </flux:badge>
                            @else
                                <flux:badge color="red">

                                    Inactive

                                </flux:badge>
                            @endif

                        </flux:table.cell>

                        <flux:table.cell class="text-right">

                            @can('update', $modelType)
                                <flux:button size="sm" variant="ghost"
                                    :href="route('administration.model-types.edit', $modelType)" wire:navigate>

                                    Edit

                                </flux:button>
                            @endcan

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="5">

                            <div class="py-8 text-center text-zinc-500">

                                No model types found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    <div class="mt-6">

        {{ $this->modelTypes->links() }}

    </div>

</x-ui.page>
