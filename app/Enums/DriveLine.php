<?php

namespace App\Enums;

enum DriveLine: string
{
    case Fwd = 'FWD';
    case Rwd = 'RWD';
    case Awd = 'AWD';
    case FourWd = '4WD';
}
