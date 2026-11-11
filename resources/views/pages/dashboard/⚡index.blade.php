<?php

use App\Livewire\Pages\BasePage;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Models\Branch;
use App\Enums\InspectionStatus;
use App\Enums\UserRole;
new #[Title('Dashboard')] class extends BasePage {
    #[Computed]
    public function stats(): array
    {
        return [
            'inspections' => Inspection::when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))->count(),
            'customers' => Customer::count(),
            'users' => User::when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))->count(),
            'today' => Inspection::whereDate('created_at', today())
                ->when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))
                ->count(),
            'registered' => Inspection::where('status', InspectionStatus::Registered)
                ->where('branch_id', auth()->user()->branch_id)
                ->count(),
            'in_progress' => Inspection::where('status', InspectionStatus::InProgress)
                ->where('branch_id', auth()->user()->branch_id)
                ->count(),
            'pending_approval' => Inspection::where('status', InspectionStatus::PendingApproval)
                ->where('branch_id', auth()->user()->branch_id)
                ->count(),
            'reinspection' => Inspection::where('status', InspectionStatus::Reinspection)
                ->where('branch_id', auth()->user()->branch_id)
                ->count(),
            'approved' => Inspection::where('status', InspectionStatus::Approved)
                ->where('branch_id', auth()->user()->branch_id)
                ->count(),
            'branches' => Branch::count(),
        ];
    }

    #[Computed]
    public function latestInspections()
    {
        return Inspection::query()
            ->when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))
            ->with(['customer', 'inspectionType', 'branch'])
            ->latest()
            ->take(10)
            ->get();
    }

    #[Computed]
    public function todayInspections()
    {
        return Inspection::query()
            ->when(auth()->user()->role !== UserRole::SuperAdmin, fn($q) => $q->where('branch_id', auth()->user()->branch_id))
            ->with(['customer', 'inspectionType'])
            ->whereDate('created_at', today())
            ->latest()
            ->take(10)
            ->get();
    }
};

?>
<x-ui.page>
    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Dashboard
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Welcome back,
                <strong>{{ auth()->user()->name }}</strong>
            </flux:text>

        </div>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Left Side --}}
        <div class="lg:col-span-2">

            <div class="grid gap-6 md:grid-cols-2">

                <x-dashboard.stat-card title="Total Inspections" :value="$this->stats['inspections']" icon="clipboard-document-list" />
                <x-dashboard.stat-card title="Today's Inspections" :value="$this->stats['today']" icon="calendar-days"
                    color="warning" />
                <x-dashboard.stat-card title="Customers" :value="$this->stats['customers']" icon="users" />
                <x-dashboard.stat-card title="Users" :value="$this->stats['users']" icon="user-group" />
                <x-dashboard.stat-card title="Branches" :value="$this->stats['branches']" icon="building-office" />


            </div>

        </div>

        {{-- Right Side --}}
        <x-dashboard.inspection-status :registered="$this->stats['registered']" :inProgress="$this->stats['in_progress']" :pendingApproval="$this->stats['pending_approval']" :reinspection="$this->stats['reinspection']"
            :approved="$this->stats['approved']" />

    </div>


    <x-dashboard.section-title title="Quick Actions" description="Frequently used operations." />

    <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @can('create', App\Models\Inspection::class)
            <x-dashboard.quick-action title="New Inspection" description="Register a new inspection." icon="plus-circle"
                :href="route('inspections.create')" />
        @endcan

        <x-dashboard.quick-action title="Customers" description="Manage customers." icon="users" :href="route('customers.index')" />

        <x-dashboard.quick-action title="Reports" description="Inspection reports." icon="document-chart-bar"
            :href="route('reports.index')" />

    </div>



    {{-- Latest Inspections --}}
    <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">

        <div class="mb-4 flex items-center justify-between">

            <flux:heading size="lg">
                Latest Inspections
            </flux:heading>

            <flux:button size="sm" variant="ghost" :href="route('inspections.index')" wire:navigate>
                View All
            </flux:button>

        </div>

        @if ($this->latestInspections->isNotEmpty())

            <flux:table>

                <flux:table.columns>

                    <flux:table.column>
                        Inspection
                    </flux:table.column>

                    <flux:table.column>
                        Customer
                    </flux:table.column>

                    <flux:table.column>
                        Type
                    </flux:table.column>

                    <flux:table.column>
                        Status
                    </flux:table.column>
                    <flux:table.column>
                        Result
                    </flux:table.column>

                </flux:table.columns>

                <flux:table.rows>

                    @foreach ($this->latestInspections as $inspection)
                        <flux:table.row>

                            <flux:table.cell>
                                {{ $inspection->report_no }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $inspection->customer?->name }}
                            </flux:table.cell>

                            <flux:table.cell>
                                {{ $inspection->inspectionType?->name }}
                            </flux:table.cell>

                            <flux:table.cell>
                                <flux:badge :color="$inspection->status->badgeColor()">
                                    {{ $inspection->status->value }}
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:badge :color="$inspection->final_result->color()">
                                    @if ($inspection->final_result)
                                        {{ $inspection->final_result }}
                                    @else
                                        Pending
                                    @endif
                                </flux:badge>
                            </flux:table.cell>

                        </flux:table.row>
                    @endforeach

                </flux:table.rows>

            </flux:table>
        @else
            <x-ui.empty-state title="No inspections" description="No inspections found." />

        @endif

    </div>




</x-ui.page>
