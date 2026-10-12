<?php

namespace App\Enums;

enum FuelType: string
{
    case Gasoline = 'Gasoline';

    case Diesel = 'Diesel';

    case Hybrid = 'Hybrid';

    case Phev = 'PHEV';

    case Ev = 'EV';
}
