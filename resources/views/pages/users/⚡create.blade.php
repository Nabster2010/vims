<?php

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Livewire\Forms\UserForm;
use App\Models\Branch;
use Livewire\Attributes\Computed;
use App\Livewire\Pages\BasePage;
use App\Models\User;
use App\Services\ToastService;
use Flux\Flux;

new class extends BasePage {
    public UserForm $form;

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }
    public function save(): void
    {
        $user = $this->form->create();

        Flux::toast(variant: 'success', text: 'User created successfully.');

        $this->redirectRoute('users.index', navigate: true);
    }

    #[Computed]
    public function branches()
    {
        return Branch::query()->orderBy('name')->get();
    }

    #[Computed]
    public function roles()
    {
        return UserRole::cases();
    }

    #[Computed]
    public function statuses()
    {
        return UserStatus::cases();
    }
};

?>

<x-ui.page>

    <flux:heading size="xl">
        Create User
    </flux:heading>

    <flux:subheading class="mt-1">
        Add a new system user.
    </flux:subheading>

    <form wire:submit="save" class="mt-6 space-y-6">

        <flux:card class="space-y-6">

            <flux:heading size="lg">
                User Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.employee_no" label="Employee No." required />

                <flux:input wire:model="form.email" type="email" label="Email" required />

                <flux:input wire:model="form.password" type="password" label="Password" required />

                <flux:select wire:model="form.branch_id" label="Branch">

                    <option value="">
                        Select Branch
                    </option>

                    @foreach ($this->branches as $branch)
                        <option value="{{ $branch->id }}">
                            {{ $branch->name }}
                        </option>
                    @endforeach

                </flux:select>

                <flux:select wire:model="form.role" label="Role">

                    @foreach ($this->roles as $role)
                        <option value="{{ $role->value }}">
                            {{ $role->label() }}
                        </option>
                    @endforeach

                </flux:select>

                <flux:select wire:model="form.status" label="Status">
                    <option value="">
                        Select Status
                    </option>

                    @foreach ($this->statuses as $status)
                        <option value="{{ $status->value }}">
                            {{ $status->label() }}
                        </option>
                    @endforeach

                </flux:select>

                <div class="flex items-end">

                    <flux:checkbox wire:model="form.force_password_change" label="Force password change" />

                </div>

            </div>

        </flux:card>

        <div class="flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('users.index')" wire:navigate>
                Cancel
            </flux:button>

            <flux:button variant="primary" type="submit">
                Save
            </flux:button>

        </div>

    </form>

</x-ui.page>
