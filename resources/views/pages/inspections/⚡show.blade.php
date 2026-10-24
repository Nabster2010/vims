<?php
use App\Models\Inspection;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Services\Inspection\InspectionModuleStatusService;
use App\Services\Inspection\InspectionFinalResultService;
use App\Services\Inspection\InspectionStepperService;
use App\Services\Inspection\InspectionSummaryService;
use App\Services\Inspection\InspectionApprovalService;
use App\Services\Inspection\InspectionReinspectionService;
use App\Services\Inspection\InspectionLockService;
use App\Livewire\Pages\BasePage;

new #[Title('Inspection Summary')] class extends BasePage {
    public Inspection $inspection;

    public function mount(Inspection $inspection): void
    {
        $this->authorize('view', $inspection);
        $this->inspection = $inspection;
    }

    #[Computed]
    public function summary(): array
    {
        return app(InspectionSummaryService::class)->summary($this->inspection->refresh());
    }
    #[Computed]
    public function moduleResults(): array
    {
        $results = [];
        foreach ($this->summary['steps'] as $step) {
            if (!$step['module']) {
                continue;
            }

            $results[$step['module']->value] = app(InspectionFinalResultService::class)->calculateModule($this->inspection, $step['module'])['result'];
        }

        return $results;
    }

    public function approve(): void
    {
        app(InspectionApprovalService::class)->approve($this->inspection, auth()->user());

        $this->inspection = $this->inspection->refresh();
    }
    public function unlock(): void
    {
        app(InspectionLockService::class)->unlock($this->inspection);

        $this->inspection = $this->inspection->refresh();
    }
    public function reinspect(): void
    {
        app(InspectionReinspectionService::class)->create($this->inspection);

        $this->inspection = $this->inspection->fresh();
    }
};
?>
<x-ui.page>

    <flux:card class="space-y-6">

        <div class="flex items-center justify-between">

            <flux:heading size="lg">
                Inspection Information
            </flux:heading>
            @can('update', $this->inspection)
                <flux:button variant="primary" :href="route('inspections.edit', $this->inspection)" icon="pencil"
                    icon-variant="outline">
                    Edit
                </flux:button>
            @endcan
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            <div>
                <flux:text size="sm" class="text-zinc-500">
                    Inspection No.
                </flux:text>

                <flux:text>
                    {{ $this->summary['inspection']->report_no }}
                </flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">
                    Inspection Type
                </flux:text>

                <flux:text>
                    {{ $this->summary['inspection']->inspectionType->name }}
                </flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">
                    Customer
                </flux:text>

                <flux:text>
                    {{ $this->summary['inspection']->customer->name }}
                </flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">
                    VIN
                </flux:text>

                <flux:text class="font-mono">
                    {{ $this->summary['inspection']->vin }}
                </flux:text>
            </div>

            <div>
                <flux:text size="sm" class="text-zinc-500">
                    Branch
                </flux:text>

                <flux:text>
                    {{ $this->summary['inspection']->branch->name }}
                </flux:text>
            </div>

        </div>

    </flux:card>
    <flux:card class="space-y-6">

        <flux:heading size="lg">
            Inspection Status
        </flux:heading>

        <div class="flex flex-wrap gap-6">

            <div>

                <flux:text size="sm" class="text-zinc-500">
                    Workflow Status
                </flux:text>

                <flux:badge :color="$this->summary['inspection']->status->badgeColor()">

                    {{ $this->summary['inspection']->status->label() }}

                </flux:badge>

            </div>

            <div>

                <flux:text size="sm" class="text-zinc-500">
                    Final Result
                </flux:text>

                <flux:badge :color="$this->summary['result']['result']->color()">

                    {{ $this->summary['result']['result']->label() }}

                </flux:badge>

            </div>
            <div>

                <flux:text size="sm" class="text-zinc-500">
                    Lock Status
                </flux:text>

                <div class="flex items-center gap-2">

                    <flux:icon :name="$this->summary['inspection']->is_locked ? 'lock-closed' : 'lock-open'" />

                    <flux:badge :color="$this->summary['inspection']->is_locked ? 'red' : 'green'">

                        {{ $this->summary['inspection']->is_locked ? 'Locked' : 'Unlocked' }}

                    </flux:badge>

                </div>

            </div>

        </div>

    </flux:card>
    @can('performInspection', $this->inspection)
        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Inspection Modules
            </flux:heading>

            <div class="space-y-3">

                @foreach ($this->summary['steps'] as $step)
                    @php

                        $color = match ($step['status']) {
                            'completed' => 'green',
                            'current' => 'blue',
                            default => 'zinc',
                        };

                    @endphp

                    <a href="{{ $step['route'] }}"
                        class="block rounded-xl border border-zinc-200 p-4 transition hover:border-zinc-300 hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-900">

                        <div class="flex items-center justify-between">

                            <div class="space-y-1">

                                @if ($step['module'])
                                    <div class="flex items-center gap-2">

                                        <flux:icon :name="$step['module']->icon()" />

                                        <span class="font-medium">
                                            {{ $step['module']->label() }}
                                        </span>

                                    </div>
                                @else
                                    <span class="font-medium">
                                        {{ $step['label'] }}
                                    </span>
                                @endif

                            </div>

                            <div class="flex items-center gap-2">

                                <flux:badge :color="$color">

                                    {{ ucfirst($step['status']) }}

                                </flux:badge>


                                <flux:icon name="chevron-right" class="text-zinc-400" />

                            </div>

                        </div>

                    </a>
                @endforeach

            </div>

        </flux:card>
    @endcan
    <flux:card class="space-y-4">

        <flux:heading size="lg">
            Failed Modules
        </flux:heading>

        @forelse($this->summary['result']['failedModules'] as $module)
            <div class="flex items-center justify-between rounded-lg border p-3">

                <div class="flex items-center gap-2">

                    <flux:icon :name="$module->icon()" />

                    <span>{{ $module->label() }}</span>

                </div>

                <flux:badge color="red">
                    Failed
                </flux:badge>

            </div>

        @empty



            @if ($this->summary['result']['isCompleted'])
                <div class="text-green-600">
                    All inspection modules passed.
                </div>
            @else
                <div class="text-zinc-500">
                    Inspection is not completed yet.
                </div>
            @endif
        @endforelse

    </flux:card>
    <flux:card class="space-y-6">

        <flux:heading size="lg">
            Failed Items
        </flux:heading>

        @forelse($this->summary['result']['failedItems'] as $item)
            <div class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 p-3">

                <flux:icon name="x-circle" class="text-red-600" />

                <span>

                    {{ $item }}

                </span>

            </div>

        @empty

            <div class="rounded-lg border border-green-200 bg-green-50 p-4">

                <div class="flex items-center gap-2">

                    <flux:icon name="check-circle" class="text-green-600" />

                    <span>

                        No failed items.

                    </span>

                </div>

            </div>
        @endforelse

    </flux:card>
    @canany(['approve', 'unlock', 'reinspect'], $this->inspection)
        <flux:card>

            <div class="flex flex-wrap gap-3">

                @if ($this->inspection->status === \App\Enums\InspectionStatus::PendingApproval)
                    <flux:button variant="primary" wire:click="approve">
                        Approve
                    </flux:button>
                @endif

                <flux:button variant="danger" wire:click="reinspect" :disabled="$this->inspection->is_locked === false">

                    Reinspection

                </flux:button>

                <flux:button variant="danger" wire:click="unlock" :disabled="$this->inspection->is_locked === false">

                    Unlock

                </flux:button>

                <flux:button variant="ghost">

                    Print Report

                </flux:button>

            </div>

        </flux:card>
    @endcanany
</x-ui.page>
