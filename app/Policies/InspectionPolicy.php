<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Inspection;
use App\Models\User;

class InspectionPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
            UserRole::Inspector,
        ]);
    }

    public function view(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
            UserRole::Inspector,
        ]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
        ]);
    }

    public function update(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
            // UserRole::Inspector,
        ]);
    }

    public function performInspection(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
    }

    public function approve(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]);
    }

    public function unlock(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]);
    }

    public function reinspect(User $user, Inspection $inspection): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]);
    }

    public function delete(User $user, Inspection $inspection): bool
    {
        return false;
    }

    public function restore(User $user, Inspection $inspection): bool
    {
        return false;
    }

    public function forceDelete(User $user, Inspection $inspection): bool
    {
        return false;
    }
}
