<?php

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Livewire\Pages\BasePage;

new #[Title('Customers')] class extends BasePage {
    use WithPagination;

    #[Url]
    public string $search = '';
    #[Url]
    public string $status = 'active';
    #[Url]
    public string $sort = 'name';
    #[Url]
    public string $direction = 'asc';
    #[Url]
    protected int $perPage = 10;

    public function mount(): void
    {
        $this->authorize('viewAny', Customer::class);
    }

    public ?int $customerToDeleteId = null;
    public bool $showDeleteConfirmation = false;

    // using route model binding to automatically inject the customer model instance into this method
    public function confirmDelete(Customer $customer): void
    {
        $this->customerToDeleteId = $customer->id;
        $this->showDeleteConfirmation = true;
    }

    public function deleteCustomer(): void
    {
        if ($this->customerToDeleteId) {
            Customer::findOrFail($this->customerToDeleteId)->delete();
        }
        $this->showDeleteConfirmation = false;
        $this->customerToDeleteId = null;
    }

    #[Computed]
    public function customers()
    {
        $query = Customer::search($this->search);

        match ($this->status) {
            'archived' => $query->onlyTrashed(),
            'all' => $query->withTrashed(),
            default => null,
        };

        return $query->orderBy($this->sort, $this->direction)->paginate($this->perPage);
    }
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $column): void
    {
        if ($this->sort === $column) {
            $this->direction = $this->direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $column;
            $this->direction = 'asc';
        }
        $this->resetPage();
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">
        <flux:heading size="xl"> Customers </flux:heading>
        @can('create', Customer::class)
            <flux:button variant="primary" icon="plus" :href="route('customers.create')" wire:navigate>
                New Customer
            </flux:button>
        @endcan
    </div>

    <div class="mt-6 flex items-end gap-4">
        <div class="flex-1">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Search customers..." />
        </div>
        <div class="w-40">
            <flux:select wire:model.live="status">
                <option value="active">Active</option>
                <option value="archived">Archived</option>
                <option value="all">All</option>
            </flux:select>
        </div>
    </div>

    <!-- Total Count -->
    <flux:text class="text-zinc-500">
        Showing {{ $this->customers->total() }} customers
    </flux:text>

    @if ($this->customers->count())
        <!-- Table -->
        <flux:table>
            <flux:table.columns>
                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('name')">
                    <div class="flex items-center gap-2">
                        <span>Name</span>

                        @if ($sort === 'name')
                            <span>
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif
                    </div>
                </flux:table.column>

                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('identity_number')">
                    <div class="flex items-center gap-2">
                        <span>Identity</span>

                        @if ($sort === 'identity_number')
                            <span>
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif
                    </div>
                </flux:table.column>
                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('mobile')">
                    <div class="flex items-center gap-2">
                        <span>Mobile</span>

                        @if ($sort === 'mobile')
                            <span>
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif
                    </div>
                </flux:table.column>
                <flux:table.column class="cursor-pointer select-none" wire:click="sortBy('customer_type')">
                    <div class="flex items-center gap-2">
                        <span>Type</span>

                        @if ($sort === 'customer_type')
                            <span>
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif
                    </div>
                </flux:table.column>
                <flux:table.column>Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->customers as $customer)
                    <flux:table.row>
                        <flux:table.cell>
                            {{ $customer->name }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $customer->identity_number }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ $customer->mobile }}
                        </flux:table.cell>

                        <flux:table.cell>
                            {{ ucfirst($customer->customer_type->value) }}
                        </flux:table.cell>

                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                @can('update', $customer)
                                    <flux:button size="sm" variant="primary" :href="route('customers.edit', $customer)"
                                        wire:navigate>
                                        Edit
                                    </flux:button>
                                @endcan

                                @can('delete', $customer)
                                    <flux:button size="sm" variant="danger"
                                        wire:click="confirmDelete({{ $customer->id }})" icon="trash">
                                        Delete
                                    </flux:button>
                                @endcan
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <x-ui.empty-state title="No customers found" description="Try changing your search or create a new customer.">
            @can('create', Customer::class)
                <flux:button :href="route('customers.create')" wire:navigate>
                    New Customer
                </flux:button>
            @endcan
        </x-ui.empty-state>
    @endif
    <div class="mt-6">
        {{ $this->customers->links() }}
    </div>
    <flux:modal wire:model="showDeleteConfirmation">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg"> Delete Customer </flux:heading>

                <flux:text class="mt-2">
                    Are you sure you want to delete this customer?
                </flux:text>
            </div>

            <x-ui.form-actions>
                <flux:button variant="ghost" wire:click="$set('showDeleteConfirmation', false)">
                    Cancel
                </flux:button>
                @can('delete', $this->customerToDeleteId)
                    <flux:button variant="danger" wire:click="deleteCustomer">
                        Delete
                    </flux:button>
                @endcan
            </x-ui.form-actions>
        </div>
    </flux:modal>
</x-ui.page>
