<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SalesRepresentative;
use App\Models\User;

class SalesRepresentativePolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === UserRole::SuperAdmin
            ? true
            : null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,
            UserRole::Receptionist,
            UserRole::Inspector,
        ]);
    }

    public function view(User $user, SalesRepresentative $salesRepresentative): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,
        ]);
    }

    public function update(User $user, SalesRepresentative $salesRepresentative): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,

        ]);
    }

    public function delete(User $user, SalesRepresentative $salesRepresentative): bool
    {
        return false;
    }

    public function restore(User $user, SalesRepresentative $salesRepresentative): bool
    {
        return false;
    }

    public function forceDelete(User $user, SalesRepresentative $salesRepresentative): bool
    {
        return false;
    }
}
