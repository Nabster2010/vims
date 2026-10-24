<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\HeadLightInspection;
use App\Models\User;

class HeadLightInspectionPolicy
{
    public function view(User $user, HeadLightInspection $headLightInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]);
    }

    public function update(User $user, HeadLightInspection $headLightInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function delete(User $user, HeadLightInspection $headLightInspection): bool
    {
        return false;
    }

    public function restore(User $user, HeadLightInspection $headLightInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, HeadLightInspection $headLightInspection): bool
    {
        return false;
    }
}
