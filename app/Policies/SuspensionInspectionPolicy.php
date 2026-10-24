<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SuspensionInspection;
use App\Models\User;

class SuspensionInspectionPolicy
{
    public function view(User $user, SuspensionInspection $suspensionInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]);
    }

    public function update(User $user, SuspensionInspection $suspensionInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function delete(User $user, SuspensionInspection $suspensionInspection): bool
    {
        return false;
    }

    public function restore(User $user, SuspensionInspection $suspensionInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, SuspensionInspection $suspensionInspection): bool
    {
        return false;
    }
}
