<?php
use App\Models\Inspection;
use App\Models\VisualItem;
use App\Enums\InspectionResult;
use App\Livewire\Forms\VisualInspectionForm;
use App\Services\VisualInspectionCalculator;
use Livewire\Attributes\Computed;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;
use App\Services\ToastService;
use Flux\Flux;

new class extends BasePage {
    public Inspection $inspection;
    public VisualInspectionForm $form;
    public array $expandedRemarks = [];

    public function mount(Inspection $inspection): void
    {
        $this->authorize('performInspection', $inspection);
        $this->inspection = $inspection->loadMissing('visualInspection', 'vehicleInformation');
        $this->form->fillFromInspection($this->inspection);
    }

    #[Computed]
    public function visualItems(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->inspection->inspectionType->visualItems()->where('is_active', true)->orderByPivot('sort_order')->orderBy('sort_order')->get();
    }
    #[Computed]
    public function groupedVisualItems()
    {
        return $this->visualItems->groupBy(fn($item) => $item->category ?: 'General');
    }

    #[Computed]
    public function calculatedResult(): ?array
    {
        return app(VisualInspectionCalculator::class)->calculate($this->form->items);
    }

    public function save(): void
    {
        app(InspectionLockService::class)->ensureUnlocked($this->inspection);
        $this->form->save($this->inspection);

        Flux::toast(variant: 'success', text: 'Visual inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl" class="text-center">
        Inspection {{ $this->inspection->inspection_no }} Visual inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <div class="space-y-6">
                <flux:heading size="xl" class="text-center">
                    Visual Inspection Checklist
                </flux:heading>



                @foreach ($this->groupedVisualItems as $category => $items)
                    <x-ui.accordion :title="$category" :count="$items->count()">
                        <div class="mt-4 space-y-4">
                            @foreach ($items as $item)
                                {{--  --}}

                                <div class="border-b border-zinc-200 py-3 last:border-0">

                                    <div class="grid items-center gap-4 md:grid-cols-12">

                                        {{-- Item --}}
                                        <div class="md:col-span-4">

                                            <flux:text class="font-medium">
                                                {{ $item->name }}
                                            </flux:text>

                                        </div>

                                        {{-- Result --}}
                                        <div class="md:col-span-4">

                                            <div class="flex gap-2">

                                                <flux:button type="button" size="sm"
                                                    variant="{{ ($form->items[$item->id]['result'] ?? null) === \App\Enums\InspectionResult::Pass->value ? 'primary' : 'ghost' }}"
                                                    wire:click="$set('form.items.{{ $item->id }}.result', '{{ \App\Enums\InspectionResult::Pass->value }}')">
                                                    PASS
                                                </flux:button>

                                                <flux:button type="button" size="sm"
                                                    variant="{{ ($form->items[$item->id]['result'] ?? null) === \App\Enums\InspectionResult::Fail->value ? 'danger' : 'ghost' }}"
                                                    wire:click="$set('form.items.{{ $item->id }}.result', '{{ \App\Enums\InspectionResult::Fail->value }}')">
                                                    FAIL
                                                </flux:button>

                                                <flux:button type="button" size="sm"
                                                    variant="{{ ($form->items[$item->id]['result'] ?? null) === \App\Enums\InspectionResult::NotApplicable->value ? 'filled' : 'ghost' }}"
                                                    wire:click="$set('form.items.{{ $item->id }}.result', '{{ \App\Enums\InspectionResult::NotApplicable->value }}')">
                                                    N/A
                                                </flux:button>

                                            </div>

                                        </div>

                                        {{-- Modified --}}
                                        <div class="md:col-span-2">

                                            <flux:checkbox wire:model.live="form.items.{{ $item->id }}.is_modified"
                                                label="Modified" />
                                        </div>
                                        <div class="md:col-span-2">
                                            <flux:button type="button" size="sm" variant="ghost"
                                                wire:click="$toggle('expandedRemarks.{{ $item->id }}')"
                                                :icon="($expandedRemarks[$item->id] ?? false) ? 'chevron-up' : 'chevron-down'">
                                                More
                                            </flux:button>

                                        </div>
                                    </div>

                                    @if ($expandedRemarks[$item->id] ?? false)
                                        <div class="mt-3">

                                            <flux:textarea wire:model="form.items.{{ $item->id }}.remarks"
                                                placeholder="Remarks..." />

                                        </div>
                                    @endif

                                </div>
                            @endforeach
                            {{--  --}}


                        </div>
                    </x-ui.accordion>
                @endforeach
            </div>
        @endif


        @if ($this->inspection->vehicleInformation)
            <x-inspection.result-summary :result="$this->calculatedResult['result']" :failed-items="$this->calculatedResult['failedItems']" />
            <flux:textarea wire:model.live="form.remarks" label="Remarks" />
        @endif
        <div class="flex justify-end">
            <flux:button variant="primary" type="submit"
                :disabled="$this->inspection->vehicleInformation === null || $this->inspection->is_locked">
                Save Visual Inspection
            </flux:button>
        </div>

    </form>
    </section>



    {{-- <pre>{{ var_dump($this->calculatedResult['failedItems']) }}</pre> --}}
</x-ui.page>
