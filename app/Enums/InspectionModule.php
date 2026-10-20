<?php

namespace App\Enums;

enum InspectionModule: string
{
    case VehicleInformation = 'vehicle_information';

    case VisualInspection = 'visual_inspection';

    case EmissionInspection = 'emission_inspection';

    case HeadLightInspection = 'head_light_inspection';

    case SideSlipInspection = 'side_slip_inspection';

    case SuspensionInspection = 'suspension_inspection';

    case BrakeInspection = 'brake_inspection';

    public function label(): string
    {
        return match ($this) {
            self::VehicleInformation => 'Vehicle Information',
            self::VisualInspection => 'Visual Inspection',
            self::EmissionInspection => 'Emission Inspection',
            self::HeadLightInspection => 'Head Light Inspection',
            self::SideSlipInspection => 'Side Slip Inspection',
            self::SuspensionInspection => 'Suspension Inspection',
            self::BrakeInspection => 'Brake Inspection',
        };
    }
}
