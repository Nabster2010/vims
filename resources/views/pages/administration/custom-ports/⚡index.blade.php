<?php

use App\Models\CustomPort;
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
    public function customPorts()
    {
        return CustomPort::query()

            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('name_ar', 'like', "%{$this->search}%")
                        ->orWhere('code', 'like', "%{$this->search}%");
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

                Custom Ports

            </flux:heading>

            <flux:subheading>

                Manage custom ports.

            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.custom-ports.create')" wire:navigate>

            New Custom Port

        </flux:button>

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search custom ports..." />

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
                    Code
                </flux:table.column>

                <flux:table.column class="w-28">
                    Status
                </flux:table.column>

                <flux:table.column class="w-24 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->customPorts as $customPort)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $customPort->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $customPort->name_ar }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $customPort->code }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($customPort->is_active)
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
                                :href="route('administration.custom-ports.edit', $customPort)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="5">

                            <div class="py-8 text-center text-zinc-500">

                                No custom ports found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    <div class="mt-6">

        {{ $this->customPorts->links() }}

    </div>

</x-ui.page>
