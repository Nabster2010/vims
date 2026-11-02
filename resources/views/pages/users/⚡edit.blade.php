<?php

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Livewire\Forms\UserForm;
use App\Livewire\Pages\BasePage;
use App\Models\Branch;
use App\Models\User;
use Livewire\Attributes\Computed;
use Flux\Flux;

new class extends BasePage {
    public User $user;

    public UserForm $form;

    public function mount(User $user): void
    {
        $this->authorize('update', $user);

        $this->user = $user;

        $this->form->fillFromUser($user);
    }

    public function save(): void
    {
        $this->form->save($this->user);

        Flux::toast(variant: 'success', text: 'User updated successfully.');
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
        Edit User
    </flux:heading>

    <flux:subheading class="mt-1">
        Update user information.
    </flux:subheading>

    <form wire:submit="save" class="mt-6 space-y-6">

        {{-- User Information --}}
        <flux:card class="space-y-6">

            <flux:heading size="lg">
                User Information
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.name" label="Name" required />

                <flux:input wire:model="form.employee_no" label="Employee No." required />

                <flux:input wire:model="form.email" type="email" label="Email" required />

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

            </div>

        </flux:card>

        {{-- Authentication --}}
        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Authentication
            </flux:heading>

            <flux:subheading>
                Leave the password blank to keep the current password.
            </flux:subheading>

            <div class="grid grid-cols-2 gap-6">

                <flux:input wire:model="form.password" type="password" label="Password" />

                <div class="flex items-end">

                    <flux:checkbox wire:model="form.force_password_change"
                        label="Force password change at next login" />

                </div>

            </div>

        </flux:card>

        {{-- Administration --}}
        <flux:card class="space-y-6">

            <flux:heading size="lg">
                Administration
            </flux:heading>

            <div class="grid grid-cols-2 gap-6">

                <flux:select wire:model="form.role" label="Role">

                    @foreach ($this->roles as $role)
                        <option value="{{ $role->value }}">
                            {{ $role->label() }}
                        </option>
                    @endforeach

                </flux:select>

                <flux:select wire:model="form.status" label="Status">

                    @foreach ($this->statuses as $status)
                        <option value="{{ $status->value }}">
                            {{ $status->label() }}
                        </option>
                    @endforeach

                </flux:select>

            </div>

        </flux:card>

        <div class="flex justify-end gap-3">

            <flux:button variant="ghost" :href="route('users.index')" wire:navigate>
                Back
            </flux:button>

            <flux:button variant="primary" type="submit">
                Save Changes
            </flux:button>

        </div>

    </form>

</x-ui.page>
