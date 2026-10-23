<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'Active';

    case Inactive = 'Inactive';

    case Locked = 'Locked';

    public function label(): string
    {
        return $this->value;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::Inactive => 'zinc',
            self::Locked => 'red',
        };
    }
}
