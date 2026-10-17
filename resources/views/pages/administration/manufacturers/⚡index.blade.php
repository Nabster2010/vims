<?php

use App\Models\Manufacturer;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function manufacturers()
    {
        return Manufacturer::query()
            ->with('country')

            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")->orWhere('name_ar', 'like', "%{$this->search}%");
                }),
            )

            ->orderBy('name')

            ->paginate(20);
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">

                Manufacturers

            </flux:heading>

            <flux:subheading>

                Manage vehicle manufacturers.

            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.manufacturers.create')" wire:navigate>

            New Manufacturer

        </flux:button>

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search manufacturers..." />

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
                <flux:table.column>
                    Country of Origin
                </flux:table.column>

                <flux:table.column class="w-28">
                    Status
                </flux:table.column>

                <flux:table.column class="w-24 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->manufacturers as $manufacturer)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $manufacturer->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $manufacturer->name_ar }}

                        </flux:table.cell>
                        <flux:table.cell>

                            {{ $manufacturer->country->name ?? 'N/A' }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($manufacturer->is_active)
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

                            <flux:button size="sm" variant="ghost"
                                :href="route('administration.manufacturers.edit', $manufacturer)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="5">

                            <div class="py-8 text-center text-zinc-500">

                                No manufacturers found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    <div class="mt-6">

        {{ $this->manufacturers->links() }}

    </div>

</x-ui.page>
