<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'Super Admin';

    case BranchManager = 'Branch Manager';

    case Inspector = 'Inspector';

    case Receptionist = 'Receptionist';

    public function label(): string
    {
        return $this->value;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::SuperAdmin => 'red',
            self::BranchManager => 'blue',
            self::Inspector => 'green',
            self::Receptionist => 'zinc',
        };
    }
}
