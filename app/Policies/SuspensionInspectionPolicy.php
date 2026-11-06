<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\SuspensionInspection;
use App\Models\User;

class SuspensionInspectionPolicy
{
    public function view(User $user, SuspensionInspection $suspensionInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]) && $user->branch_id === $suspensionInspection->inspection->branch_id;
    }

    public function update(User $user, SuspensionInspection $suspensionInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $suspensionInspection->inspection->branch_id;
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
