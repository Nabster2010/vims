<?php

namespace App\Enums;

enum InspectionTypeCode: string
{
    case ImportedVehicle = 'IV';

    case SaberGasolineDiesel = 'SG';

    case SaberEVHEV = 'SE';

    case ModifiedLess3500 = 'ML';

    case ModifiedMore3500 = 'MH';

    case Motorcycle = 'MC';
}