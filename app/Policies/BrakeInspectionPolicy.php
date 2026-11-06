<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\BrakeInspection;

class BrakeInspectionPolicy
{
    public function view(User $user, BrakeInspection $brakeInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]) && $user->branch_id === $brakeInspection->inspection->branch_id;
    }

    public function update(User $user, BrakeInspection $brakeInspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $brakeInspection->inspection->branch_id;
    }

    public function delete(User $user, BrakeInspection $brakeInspection): bool
    {
        return false;
    }

    public function restore(User $user, BrakeInspection $brakeInspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, BrakeInspection $brakeInspection): bool
    {
        return false;
    }
}
