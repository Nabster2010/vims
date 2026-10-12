<?php

namespace App\Enums;

enum AirIntake: string
{
    case NaturallyAspirated = 'Naturally Aspirated';
    case Turbocharged = 'Turbocharged';
    case Supercharged = 'Supercharged';
    case Intercooler = 'Intercooler';
}
