<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Country;
use App\Models\User;

class CountryPolicy
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

    public function view(User $user, Country $country): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,
        ]);
    }

    public function update(User $user, Country $country): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,

        ]);
    }

    public function delete(User $user, Country $country): bool
    {
        return false;
    }

    public function restore(User $user, Country $country): bool
    {
        return false;
    }

    public function forceDelete(User $user, Country $country): bool
    {
        return false;
    }
}
