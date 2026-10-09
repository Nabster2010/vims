<?php

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new #[Title('Customers')] class extends Component {
    use WithPagination;

    #[Url]
    public string $search = '';
    #[Url]
    public string $sort = 'name';
    #[Url]
    public string $direction = 'asc';
    #[Url]
    public string $status = 'active';

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
        Customer::findOrFail($this->customerToDeleteId)->delete();
        $this->showDeleteConfirmation = false;
        $this->customerToDeleteId = null;
    }

    #[Computed]
    public function customers()
    {
        //this is "Local Query Scope " search() defined in the Customer model
        $query = Customer::search($this->search);
        if ($this->status === 'archived') {
            $query->onlyTrashed();
        }
        if ($this->status === 'all') {
            $query->withTrashed();
        }

        return $query->orderBy($this->sort, $this->direction)->paginate(10);
    }
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    public function updateStatus(): void
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

<section class="w-full">
    <div class="flex items-center justify-between">
        <flux:heading size="xl"> Customers </flux:heading>

        <flux:button variant="primary" :href="route('customers.create')" wire:navigate>
            Create Customer
        </flux:button>
    </div>

    <div class="mt-6 flex items-end gap-4">
        <div class="flex-1">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Search customers..." />
        </div>
        <div class="w-40">
            <flux:select wire:model.live="status">
                <option value=" active">Active</option>
                <option value="archived">Archived</option>
                <option value="all">All</option>
            </flux:select>
        </div>
    </div>

    <!-- Total Count -->

    <div class="mt-4 flex items-center justify-between">
        <flux:text class="text-zinc-500">
            Showing {{ $this->customers->total() }} customers
        </flux:text>
    </div>

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
                            <div class="flex gap-2">
                                <flux:button size="sm" variant="primary" :href="route('customers.edit', $customer)"
                                    wire:navigate>
                                    Edit
                                </flux:button>

                                <flux:button size="sm" variant="danger"
                                    wire:click="confirmDelete({{ $customer->id }})" icon="trash">
                                    Delete
                                </flux:button>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @else
        <flux:card class="py-12 mt-4">
            <div class="space-y-4 text-center">
                <flux:heading> No customers found </flux:heading>

                <flux:text class="text-zinc-500">
                    Try changing your search or create a new customer.
                </flux:text>

                <flux:button :href="route('customers.create')" wire:navigate>
                    Create Customer
                </flux:button>
            </div>
        </flux:card>
    @endif
    {{ $this->customers->links() }}
    <flux:modal wire:model="showDeleteConfirmation">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg"> Delete Customer </flux:heading>

                <flux:text class="mt-2">
                    Are you sure you want to delete this customer?
                </flux:text>
            </div>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" wire:click="$set('showDeleteConfirmation', false)">
                    Cancel
                </flux:button>

                <flux:button variant="danger" wire:click="deleteCustomer">
                    Delete
                </flux:button>
            </div>
        </div>
    </flux:modal>
</section>
