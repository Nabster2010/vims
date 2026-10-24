<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\ModelType;
use App\Models\User;

class ModelTypePolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === UserRole::SuperAdmin
            ? true
            : null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,
            UserRole::Receptionist,
            UserRole::Inspector,
        ]);
    }

    public function view(User $user, ModelType $modelType): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,

        ]);
    }

    public function update(User $user, ModelType $modelType): bool
    {
        return in_array($user->role, [
            UserRole::BranchManager,

        ]);
    }

    public function delete(User $user, ModelType $modelType): bool
    {
        return false;
    }

    public function restore(User $user, ModelType $modelType): bool
    {
        return false;
    }

    public function forceDelete(User $user, ModelType $modelType): bool
    {
        return false;
    }
}
