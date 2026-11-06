<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\HeadLightInspection;
use App\Models\User;

class HeadLightInspectionPolicy
{
    public function view(User $user, HeadLightInspection $headLightInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]) && $user->branch_id === $headLightInspection->inspection->branch_id;
    }

    public function update(User $user, HeadLightInspection $headLightInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $headLightInspection->inspection->branch_id;
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
