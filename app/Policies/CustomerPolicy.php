<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Receptionist,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function view(User $user, Customer $customer): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Receptionist,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Receptionist,
            UserRole::BranchManager,
        ]);
    }

    public function update(User $user, Customer $customer): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::Receptionist,
            UserRole::BranchManager,
        ]);
    }

    public function delete(User $user, Customer $customer): bool
    {
        // Only super admins can delete customers
        return $user->role === UserRole::SuperAdmin;
    }

    public function restore(User $user, Customer $customer): bool
    {
        return false;
    }

    public function forceDelete(User $user, Customer $customer): bool
    {
        return false;
    }
}
