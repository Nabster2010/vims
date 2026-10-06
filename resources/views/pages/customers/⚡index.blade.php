<?php

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title("Customers")] class extends Component {
    public string $search = "";

    #[Computed]
    public function customers()
    {
        //this is "Local Query Scope " search() defined in the Customer model
        return Customer::search($this->search)->orderBy("name")->paginate(10);
    }
};
?>

<section class="w-full">
    <div class="flex items-center justify-between">
        <flux:heading size="xl"> Customers </flux:heading>

        <flux:button
            variant="primary"
            :href="route('customers.create')"
            wire:navigate
        >
            Create Customer
        </flux:button>
    </div>

    <div class="mt-6">
        <flux:input
            wire:model.live.debounce.300ms="search"
            placeholder="Search customers..."
        />
    </div>
    <!-- Total Count -->

    <div class="mt-4 flex items-center justify-between">
        <flux:text>
            Showing {{ $this->customers->total() }} customers
        </flux:text>
    </div>

    <!-- Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>

            <flux:table.column>Identity</flux:table.column>

            <flux:table.column>Mobile</flux:table.column>

            <flux:table.column>Type</flux:table.column>

            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($this->customers as $customer)
                <flux:table.row>
                    <flux:table.cell> {{ $customer->name }} </flux:table.cell>

                    <flux:table.cell>
                        {{ $customer->identity_number }}
                    </flux:table.cell>

                    <flux:table.cell> {{ $customer->mobile }} </flux:table.cell>

                    <flux:table.cell>
                        {{
                            ucfirst(
                                $customer->customer_type->value,
                            )
                        }}
                    </flux:table.cell>

                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button
                                size="sm"
                                variant="primary"
                                :href="route('customers.edit', $customer)"
                                wire:navigate
                            >
                                Edit
                            </flux:button>

                            <flux:button size="sm" variant="danger">
                                Delete
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>

            @endforeach
        </flux:table.rows>
    </flux:table>
    {{ $this->customers->links() }}
</section>
