<?php

namespace App\Enums;

enum IdentityType: string
{
    case NationalID = 'National ID';
    case Iqama = 'Iqama';
    case Passport = 'Passport';
    case CommercialRegistration = 'Commercial Registration';
}