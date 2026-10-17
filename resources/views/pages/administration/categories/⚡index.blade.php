<?php

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component {
    #[Computed]
    public function categories()
    {
        return Category::query()->orderBy('name')->get();
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">
                Categories
            </flux:heading>

            <flux:subheading>
                Manage vehicle categories.
            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('administration.categories.create')" wire:navigate>

            New Category

        </flux:button>

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

                @forelse($this->categories as $category)
                    <flux:table.row>

                        <flux:table.cell>

                            {{ $category->name }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $category->name_ar }}

                        </flux:table.cell>

                        <flux:table.cell>

                            @if ($category->is_active)
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
                                :href="route('administration.categories.edit', $category)" wire:navigate>

                                Edit

                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="4">

                            <div class="py-8 text-center text-zinc-500">

                                No categories found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

    </flux:card>

</x-ui.page>
