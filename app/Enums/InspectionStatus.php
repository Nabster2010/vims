<?php

namespace App\Enums;

enum InspectionStatus: string
{
    case Registered = 'Registered';

    case InProgress = 'In Progress';

    case PendingApproval = 'Pending Approval';

    case Approved = 'Approved';

    case Reinspection = 'Reinspection';
}
