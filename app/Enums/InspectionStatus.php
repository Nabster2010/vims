<?php

namespace App\Enums;

enum InspectionStatus: string
{
    case Registered = 'Registered';

    case InProgress = 'In Progress';

    case PendingApproval = 'Pending Approval';

    case Approved = 'Approved';

    case Reinspection = 'Reinspection';

    public function label(): string
    {
        return $this->value;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Registered => 'zinc',
            self::InProgress => 'blue',
            self::PendingApproval => 'amber',
            self::Approved => 'green',
            self::Reinspection => 'red',
        };
    }
}
