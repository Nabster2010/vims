<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VisualItem;

class VisualItemPolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === UserRole::SuperAdmin
            ? true
            : null;
    }

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, VisualItem $visualItem): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, VisualItem $visualItem): bool
    {
        return false;
    }

    public function delete(User $user, VisualItem $visualItem): bool
    {
        return false;
    }

    public function restore(User $user, VisualItem $visualItem): bool
    {
        return false;
    }

    public function forceDelete(User $user, VisualItem $visualItem): bool
    {
        return false;
    }
}
