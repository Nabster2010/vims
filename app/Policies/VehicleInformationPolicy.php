<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VehicleInformation;

class VehicleInformationPolicy
{
    public function view(User $user, VehicleInformation $vehicleInformation): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
            // UserRole::Receptionist,
        ]);
    }

    public function update(User $user, VehicleInformation $vehicleInformation): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin,
            UserRole::BranchManager,
            UserRole::Inspector,
        ]);
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
