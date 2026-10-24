<?php

use App\Models\SalesRepresentative;
use App\Livewire\Pages\BasePage;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

new class extends BasePage {
    use WithPagination;

    public string $search = '';

    public function mount(): void
    {
        $this->authorize('viewAny', SalesRepresentative::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function salesRepresentatives()
    {
        return SalesRepresentative::query()

            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('company_name', 'like', "%{$this->search}%")
                        ->orWhere('mobile', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
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
                Sales Representatives
            </flux:heading>

            <flux:subheading>
                Manage sales representatives.
            </flux:subheading>

        </div>
        @can('create', SalesRepresentative::class)
            <flux:button variant="primary" :href="route('administration.sales-representatives.create')" wire:navigate>

                New Sales Representative

            </flux:button>
        @endcan

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search..." />

    </div>
    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    Name
                </flux:table.column>

                <flux:table.column>
                    Company
                </flux:table.column>

                <flux:table.column>
                    Mobile
                </flux:table.column>

                <flux:table.column>
                    Email
                </flux:table.column>

                <flux:table.column class="w-32">
                    Status
                </flux:table.column>

                <flux:table.column class="w-24 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->salesRepresentatives as $salesRepresentative)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $salesRepresentative->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $salesRepresentative->company_name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $salesRepresentative->mobile }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $salesRepresentative->email }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($salesRepresentative->is_active)
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
                            @can('update', $salesRepresentative)
                                <flux:button size="sm" variant="ghost"
                                    :href="route('administration.sales-representatives.edit', $salesRepresentative)"
                                    wire:navigate>

                                    Edit

                                </flux:button>
                            @endcan
                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            <div class="py-8 text-center text-zinc-500">

                                No sales representatives found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    <div class="mt-6">

        {{ $this->salesRepresentatives->links() }}

    </div>

</x-ui.page>
