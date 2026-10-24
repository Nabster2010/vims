<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SideSlipInspection;
use App\Models\User;

class SideSlipInspectionPolicy
{
    public function view(User $user, SideSlipInspection $sideSlipInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]);
    }

    public function update(User $user, SideSlipInspection $sideSlipInspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function delete(User $user, SideSlipInspection $sideSlipInspection): bool
    {
        return false;
    }

    public function restore(User $user, SideSlipInspection $sideSlipInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, SideSlipInspection $sideSlipInspection): bool
    {
        return false;
    }
}
