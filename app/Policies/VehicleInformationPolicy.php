<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VehicleInformation;

class VehicleInformationPolicy
{
    public function view(User $user, VehicleInformation $vehicleInformation): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]) && $user->branch_id === $vehicleInformation->inspection->branch_id;
    }

    public function update(User $user, VehicleInformation $vehicleInformation): bool
    {
        if ($user->role === UserRole::SuperAdmin) {
            return true;
        }
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]) && $user->branch_id === $vehicleInformation->inspection->branch_id;
    }

    public function delete(User $user, VehicleInformation $vehicleInformation): bool
    {
        return false;
    }

    public function restore(User $user, VehicleInformation $vehicleInformation): bool
    {
        return false;
    }

    public function forceDelete(User $user, VehicleInformation $vehicleInformation): bool
    {
        return false;
    }
}
