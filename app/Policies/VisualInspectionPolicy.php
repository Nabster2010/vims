<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\VisualInspection;
use App\Models\User;

class VisualInspectionPolicy
{
    public function view(User $user, VisualInspection $visualInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]) && $user->branch_id === $visualInspection->inspection->branch_id;
    }

    public function update(User $user, VisualInspection $visualInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $visualInspection->inspection->branch_id;
    }

    public function delete(User $user, VisualInspection $visualInspection): bool
    {
        return false;
    }

    public function restore(User $user, VisualInspection $visualInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, VisualInspection $visualInspection): bool
    {
        return false;
    }
}
