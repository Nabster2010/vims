<?php

namespace App\Enums;

enum FuelType: string
{
    case Gasoline = 'Gasoline';

    case Diesel = 'Diesel';

    case Hybrid = 'Hybrid';

    case Phev = 'PHEV';

    case Ev = 'EV';

    public function label_ar(): string
    {
        return match ($this) {
            self::Gasoline => 'بنزين',
            self::Diesel => 'ديزل',
            self::Hybrid => 'هجين',
            self::Phev => ' هجين بقابس',
            self::Ev => ' كهربائية ',
        };
    }
}
