<?php

namespace App\Policies;

use App\Enums\InspectionResult;
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
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
            UserRole::Inspector,
        ]) && $user->branch_id === $inspection->branch_id;
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
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Receptionist,
            // UserRole::Inspector,
        ]) && $user->branch_id === $inspection->branch_id;
    }

    public function performInspection(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $inspection->branch_id;
    }

    public function approve(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]) && $user->branch_id === $inspection->branch_id;
    }

    public function unlock(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]) && $user->branch_id === $inspection->branch_id;
    }

    public function reinspect(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
        ]) && $user->branch_id === $inspection->branch_id;
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

    public function viewReport(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            UserRole::Receptionist,
        ]) && in_array($inspection->final_result, [
            InspectionResult::Pass,
            InspectionResult::Fail,
        ]) && $user->branch_id === $inspection->branch_id;
    }

    public function downloadReport(User $user, Inspection $inspection): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            UserRole::Receptionist,
        ])  && in_array($inspection->final_result, [
            InspectionResult::Pass,
            InspectionResult::Fail,
        ]) && $user->branch_id === $inspection->branch_id;
    }
}
