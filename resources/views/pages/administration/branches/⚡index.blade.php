<?php

use App\Models\Branch;
use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component {
    #[Computed]
    public function branches()
    {
        return Branch::query()->orderBy('name')->get();
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">
                Branches
            </flux:heading>

            <flux:subheading>
                Manage inspection branches.
            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.branches.create')" wire:navigate>

            New Branch

        </flux:button>

    </div>

    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    Code
                </flux:table.column>

                <flux:table.column>
                    Name
                </flux:table.column>

                <flux:table.column>
                    Arabic Name
                </flux:table.column>

                <flux:table.column>
                    Phone
                </flux:table.column>

                <flux:table.column>
                    Status
                </flux:table.column>

                <flux:table.column class="text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse ($this->branches as $branch)
                    <flux:table.row>

                        <flux:table.cell>
                            {{ $branch->code }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $branch->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $branch->name_ar }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $branch->phone }}
                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($branch->is_active)
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
                                :href="route('administration.branches.edit', $branch)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            <div class="py-8 text-center text-zinc-500">

                                No branches found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

</x-ui.page>
