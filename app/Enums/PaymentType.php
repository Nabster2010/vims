<?php

namespace App\Enums;

enum PaymentType: string
{
    case Cash = 'Cash';

    case Card = 'Card';

    case Account = 'Account';

    case Online = 'Online';
}