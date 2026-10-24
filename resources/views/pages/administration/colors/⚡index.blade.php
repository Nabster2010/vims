<?php

use App\Models\Color;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Livewire\Pages\BasePage;

new class extends BasePage {
    use WithPagination;
    public string $search = '';

    public function mount(): void
    {
        $this->authorize('viewAny', Color::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    #[Computed]
    public function colors()
    {
        return Color::query()

            ->when(
                $this->search,

                fn($query) => $query->where(function ($query) {
                    $query

                        ->where('name', 'like', "%{$this->search}%")

                        ->orWhere('name_ar', 'like', "%{$this->search}%");
                }),
            )
            ->orderBy('name')
            ->paginate(10);
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">
                Colors
            </flux:heading>

            <flux:subheading>
                Manage vehicle Colors.
            </flux:subheading>

        </div>
        @can('create', Color::class)
            <flux:button variant="primary" :href="route('administration.colors.create')" wire:navigate>

                New Color

            </flux:button>
        @endcan

    </div>
    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search colors..." />

    </div>
    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    Name
                </flux:table.column>

                <flux:table.column>
                    Arabic Name
                </flux:table.column>

                <flux:table.column class="w-32">
                    Status
                </flux:table.column>

                <flux:table.column class="w-32 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($this->colors  as $color)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $color->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $color->name_ar }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($color->is_active)
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

                            @can('update', $color)
                                <flux:button size="sm" variant="ghost"
                                    :href="route('administration.colors.edit', $color)" wire:navigate>

                                    Edit

                                </flux:button>
                            @endcan

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="4">

                            <div class="py-8 text-center text-zinc-500">

                                No colors found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>
        <div class="mt-6">
            {{ $this->colors->links() }}
        </div>
    </flux:card>

</x-ui.page>
