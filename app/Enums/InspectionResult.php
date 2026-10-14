<?php

namespace App\Enums;

enum InspectionResult: string
{
    case Pass = 'Pass';
    case Fail = 'Fail';
    case Pending = 'Pending';

    public function label(): string
    {
        return match ($this) {
            self::Pass => 'Pass',
            self::Fail => 'Fail',
            self::Pending => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pass => 'green',
            self::Fail => 'red',
            self::Pending => 'zinc', // أو gray حسب Flux
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Pass => 'check-circle',
            self::Fail => 'x-circle',
            self::Pending => 'clock',
        };
    }
}
