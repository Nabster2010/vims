<?php

namespace App\Enums;

enum InspectionResult: string
{
    case Pass = 'Pass';

    case Fail = 'Fail';

    case Pending = 'Pending';
}