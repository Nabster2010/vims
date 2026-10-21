<?php

namespace App\Enums;

enum InspectionModule: string
{
    case VehicleInformation = 'vehicle-information';

    case EmissionInspection = 'emission-inspection';

    case HeadLightInspection = 'head-light-inspection';

    case SideSlipInspection = 'side-slip-inspection';

    case SuspensionInspection = 'suspension-inspection';

    case BrakeInspection = 'brake-inspection';

    case VisualInspection = 'visual-inspection';

    public function label(): string
    {
        return match ($this) {

            self::VehicleInformation => 'Vehicle Information',

            self::EmissionInspection => 'Emission Inspection',

            self::HeadLightInspection => 'Head Light Inspection',

            self::SideSlipInspection => 'Side Slip Inspection',

            self::SuspensionInspection => 'Suspension Inspection',

            self::BrakeInspection => 'Brake Inspection',

            self::VisualInspection => 'Visual Inspection',
        };
    }

    public function relation(): string
    {
        return match ($this) {

            self::VehicleInformation => 'vehicleInformation',

            self::EmissionInspection => 'emissionInspection',

            self::HeadLightInspection => 'headLightInspection',

            self::SideSlipInspection => 'sideSlipInspection',

            self::SuspensionInspection => 'suspensionInspection',

            self::BrakeInspection => 'brakeInspection',

            self::VisualInspection => 'visualInspection',
        };
    }

    public function route(): string
    {
        return match ($this) {

            self::VehicleInformation =>
            'inspections.vehicle-information.edit',

            self::EmissionInspection =>
            'inspections.emission-inspection.edit',

            self::HeadLightInspection =>
            'inspections.head-light-inspection.edit',

            self::SideSlipInspection =>
            'inspections.side-slip-inspection.edit',

            self::SuspensionInspection =>
            'inspections.suspension-inspection.edit',

            self::BrakeInspection =>
            'inspections.brake-inspection.edit',

            self::VisualInspection =>
            'inspections.visual-inspection.edit',
        };
    }

    public function icon(): string
    {
        return match ($this) {

            self::VehicleInformation => 'truck',

            self::EmissionInspection => 'cloud',

            self::HeadLightInspection => 'light-bulb',

            self::SideSlipInspection => 'arrows-right-left',

            self::SuspensionInspection => 'adjustments-horizontal',

            self::BrakeInspection => 'stop-circle',

            self::VisualInspection => 'eye',
        };
    }
}
