<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\EmissionInspection;

class EmissionInspectionPolicy
{
    public function view(User $user, EmissionInspection $emissionInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]);
    }

    public function update(User $user, EmissionInspection $emissionInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function delete(User $user, EmissionInspection $emissionInspection): bool
    {
        return false;
    }

    public function restore(User $user, EmissionInspection $emissionInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, EmissionInspection $emissionInspection): bool
    {
        return false;
    }
}
