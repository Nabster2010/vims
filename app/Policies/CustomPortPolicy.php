<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\CustomPort;
use App\Models\User;

class CustomPortPolicy
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

    public function view(User $user, CustomPort $customPort): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,
        ]);
    }

    public function update(User $user, CustomPort $customPort): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,

        ]);
    }

    public function delete(User $user, CustomPort $customPort): bool
    {
        return false;
    }

    public function restore(User $user, CustomPort $customPort): bool
    {
        return false;
    }

    public function forceDelete(User $user, CustomPort $customPort): bool
    {
        return false;
    }
}
