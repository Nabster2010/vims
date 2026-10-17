<?php

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function countries()
    {
        return Country::query()

            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('name_ar', 'like', "%{$this->search}%")
                        ->orWhere('iso2', 'like', "%{$this->search}%")
                        ->orWhere('iso3', 'like', "%{$this->search}%");
                }),
            )

            ->orderBy('name')
            ->orderBy('iso2')

            ->paginate(20);
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">

                Countries

            </flux:heading>

            <flux:subheading>

                Manage countries.

            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.countries.create')" wire:navigate>

            New Country

        </flux:button>

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search countries..." />

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

                <flux:table.column class="w-24">
                    ISO2
                </flux:table.column>

                <flux:table.column class="w-24">
                    ISO3
                </flux:table.column>

                <flux:table.column class="w-28">
                    Status
                </flux:table.column>

                <flux:table.column class="w-24 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->countries as $country)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $country->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $country->name_ar }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $country->iso2 }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $country->iso3 }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($country->is_active)
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
                                :href="route('administration.countries.edit', $country)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            <div class="py-8 text-center text-zinc-500">

                                No countries found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

    <div class="mt-6">

        {{ $this->countries->links() }}

    </div>

</x-ui.page>
