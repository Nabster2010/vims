<?php

use App\Models\InspectionType;
use App\Models\VisualItem;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\InspectionTypeVisualInspectionForm;
use Illuminate\Database\Eloquent\Collection;

new class extends BasePage {
    public InspectionType $inspectionType;
    public Collection $visualItems;
    public InspectionTypeVisualInspectionForm $form;

    public function mount(InspectionType $inspectionType): void
    {
        $this->authorize('update', $inspectionType);
        $this->inspectionType = $inspectionType->load('visualItems');
        $this->visualItems = VisualItem::query()->where('is_active', true)->orderBy('category')->orderBy('sort_order')->get();
        $this->form->fillFromInspectionType($inspectionType, $this->visualItems);
    }

    #[Computed]
    public function categories()
    {
        return $this->visualItems->groupBy('category');
    }
    #[Computed]
    public function selectedCount(): int
    {
        return collect($this->form->items)->where('selected', true)->count();
    }
    public function selectAll(): void
    {
        foreach ($this->form->items as $itemId => $item) {
            $this->form->items[$itemId]['selected'] = true;
        }
    }
    public function clearAll(): void
    {
        foreach ($this->form->items as $itemId => $item) {
            $this->form->items[$itemId]['selected'] = false;
        }
    }
    public function save(): void
    {
        $this->form->save($this->inspectionType);

        ToastService::success('Visual inspection items updated successfully.');
        $this->redirectRoute('administration.inspection-types.index', navigate: true);
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">

        {{ $inspectionType->name }}

    </flux:heading>

    <flux:subheading class="mt-1">

        Visual Inspection Items

    </flux:subheading>
    <form wire:submit="save" class="mt-6 space-y-6">
        <div class="flex items-center justify-between">

            <flux:text>
                {{ $this->selectedCount }} selected
            </flux:text>

            <div class="flex gap-2">

                <flux:button type="button" variant="ghost" wire:click="selectAll">

                    Select All

                </flux:button>

                <flux:button type="button" variant="ghost" wire:click="clearAll">

                    Clear All

                </flux:button>

            </div>

        </div>

        <div class="mt-6 space-y-6">

            @forelse($this->categories as $category => $items)

                <flux:card>

                    <flux:heading size="lg" class="mb-4">

                        {{ $category }}

                    </flux:heading>

                    <flux:table>

                        <flux:table.columns>

                            <flux:table.column class="w-20 text-center">
                                Use
                            </flux:table.column>

                            <flux:table.column>
                                Item
                            </flux:table.column>

                            <flux:table.column class="w-28 text-center">
                                Required
                            </flux:table.column>

                            <flux:table.column class="w-32">
                                Sort Order
                            </flux:table.column>

                            <flux:table.column class="w-40">
                                Code
                            </flux:table.column>

                        </flux:table.columns>

                        <flux:table.rows>

                            @foreach ($items as $item)
                                <flux:table.row>

                                    <flux:table.cell class="text-center">

                                        <flux:checkbox wire:model.live="form.items.{{ $item->id }}.selected" />

                                    </flux:table.cell>

                                    <flux:table.cell>

                                        <div class="font-medium">
                                            {{ $item->name }}
                                        </div>

                                    </flux:table.cell>

                                    <flux:table.cell class="text-center">

                                        <flux:checkbox wire:model.live="form.items.{{ $item->id }}.required"
                                            :disabled="!$form->items[$item->id]['selected']" />

                                    </flux:table.cell>

                                    <flux:table.cell>

                                        <flux:input type="number" min="1" class="w-24"
                                            wire:model.live="form.items.{{ $item->id }}.sort_order"
                                            :disabled="!$form->items[$item->id]['selected']" />

                                    </flux:table.cell>

                                    <flux:table.cell>

                                        <span class="text-zinc-500">
                                            {{ $item->code }}
                                        </span>

                                    </flux:table.cell>

                                </flux:table.row>
                            @endforeach

                        </flux:table.rows>

                    </flux:table>

                </flux:card>

            @empty

                <flux:callout variant="warning">

                    No visual inspection items found.

                </flux:callout>

            @endforelse

        </div>
        <div class="flex justify-end mt-6">

            <flux:button variant="primary" type="submit">

                Save Changes

            </flux:button>

        </div>

    </form>

</x-ui.page>
