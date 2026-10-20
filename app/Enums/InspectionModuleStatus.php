<?php

namespace App\Enums;

enum InspectionModuleStatus: string
{
    case NotStarted = 'not_started';

    case Completed = 'completed';

    public function color(): string
    {
        return match ($this) {
            self::NotStarted => 'zinc',
            self::Completed => 'green',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::NotStarted => 'minus-circle',
            self::Completed => 'check-circle',
        };
    }
}
