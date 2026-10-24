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

new class extends BasePage {
    public Inspection $inspection;
    public VisualInspectionForm $form;

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

        ToastService::success('Visual inspection saved successfully.');

        $this->redirectRoute('inspections.show', $this->inspection, navigate: true);
    }
};
?>

<x-ui.page>

    <flux:heading size="xl">
        Inspection {{ $this->inspection->inspection_no }} Visual inspection
    </flux:heading>
    <form wire:submit="save" class="mt-6 space-y-6">
        @if (!$this->inspection->vehicleInformation)
            <flux:callout variant="warning">
                Please complete Vehicle Information first.
            </flux:callout>
        @else
            <flux:card class="space-y-6">
                <flux:heading size="lg">
                    Visual Inspection Checklist
                </flux:heading>

                @foreach ($this->groupedVisualItems as $category => $items)
                    <flux:card class="mb-6">

                        <flux:heading size="lg">

                            {{ $category }}

                        </flux:heading>

                        <div class="mt-4 space-y-4">

                            @foreach ($items as $item)
                                <div class="border-b border-zinc-200 pb-4 last:border-0">

                                    <flux:heading size="sm">

                                        {{ $item->name }}

                                    </flux:heading>

                                    <flux:select wire:model.live="form.items.{{ $item->id }}.result">

                                        <option value="Pass">Pass</option>

                                        <option value="Fail">Fail</option>

                                    </flux:select>

                                    <flux:textarea wire:model="form.items.{{ $item->id }}.remarks"
                                        label="Remarks" />
                                </div>
                            @endforeach

                        </div>

                    </flux:card>
                @endforeach
            </flux:card>
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
