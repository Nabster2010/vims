<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Branch;
use App\Models\User;

class BranchPolicy
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

    public function view(User $user, Branch $branch): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Branch $branch): bool
    {
        return false;
    }

    public function delete(User $user, Branch $branch): bool
    {
        return false;
    }
}
