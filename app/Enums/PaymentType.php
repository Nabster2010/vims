<?php

namespace App\Enums;

enum PaymentType: string
{
    case Cash = 'Cash';

    case Card = 'Card';

    case Credit = 'Credit';

    case Online = 'Online';

    public function label(): string
    {

        return match ($this) {
            self::Cash => 'Cash',
            self::Credit => 'Credit',
            self::Card => 'Card',
            self::Online => 'Online',
        };
    }
}
