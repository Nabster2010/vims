<?php

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function users()
    {
        return User::query()
            ->with('branch')
            ->when(
                $this->search,
                fn($query) => $query->where(function ($query) {
                    $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('employee_no', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                }),
            )
            ->orderBy('name')
            ->paginate(10);
    }
};

?>

<x-ui.page>

    <div class="flex items-center justify-between">

        <div>

            <flux:heading size="xl">
                Users
            </flux:heading>

            <flux:subheading>
                Manage system users.
            </flux:subheading>

        </div>

        <flux:button variant="primary" :href="route('users.create')" wire:navigate>
            New User
        </flux:button>

    </div>

    <div class="mt-6">

        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search users..." />

    </div>

    <flux:card class="mt-6">

        <flux:table>

            <flux:table.columns>

                <flux:table.column>
                    Name
                </flux:table.column>

                <flux:table.column>
                    Employee No.
                </flux:table.column>

                <flux:table.column>
                    Branch
                </flux:table.column>

                <flux:table.column>
                    Role
                </flux:table.column>

                <flux:table.column>
                    Status
                </flux:table.column>

                <flux:table.column class="w-32 text-right">
                    Actions
                </flux:table.column>

            </flux:table.columns>

            <flux:table.rows>

                @forelse($this->users as $user)
                    <flux:table.row>

                        <flux:table.cell>

                            <div class="font-medium">

                                {{ $user->name }}

                            </div>

                            <div class="text-sm text-zinc-500">

                                {{ $user->email }}

                            </div>

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $user->employee_no }}

                        </flux:table.cell>

                        <flux:table.cell>

                            {{ $user->branch?->name ?? '-' }}

                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge :color="$user->role->badgeColor()">

                                {{ $user->role->label() }}

                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell>

                            <flux:badge :color="$user->status->badgeColor()">

                                {{ $user->status->label() }}

                            </flux:badge>

                        </flux:table.cell>

                        <flux:table.cell class="text-right">

                            <flux:button size="sm" variant="ghost" :href="route('users.edit', $user)"
                                wire:navigate>
                                Edit
                            </flux:button>

                        </flux:table.cell>

                    </flux:table.row>

                @empty

                    <flux:table.row>

                        <flux:table.cell colspan="6">

                            <div class="py-8 text-center text-zinc-500">

                                No users found.

                            </div>

                        </flux:table.cell>

                    </flux:table.row>
                @endforelse

            </flux:table.rows>

        </flux:table>

        <div class="mt-6">

            {{ $this->users->links() }}

        </div>

    </flux:card>

</x-ui.page>
