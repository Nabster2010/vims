<?php

namespace App\Enums;

enum PhotoType: string
{
    case FRONT = 'front';
    case REAR = 'rear';
    case LEFT = 'left';
    case RIGHT = 'right';
    case VIN = 'vin';
    case ENGINE = 'engine';
    case DASHBOARD = 'dashboard';
    case ODOMETER = 'odometer';

    public function label(): string
    {
        return match ($this) {
            self::FRONT => 'Front View',
            self::REAR => 'Rear View',
            self::LEFT => 'Left Side',
            self::RIGHT => 'Right Side',
            self::VIN => 'VIN Plate',
            self::ENGINE => 'Engine',
            self::DASHBOARD => 'Dashboard',
            self::ODOMETER => 'Odometer',
        };
    }

    public function labelAr(): string
    {
        return match ($this) {
            self::FRONT => 'الواجهة الأمامية',
            self::REAR => 'الواجهة الخلفية',
            self::LEFT => 'الجانب الأيسر',
            self::RIGHT => 'الجانب الأيمن',
            self::VIN => 'رقم الهيكل (VIN)',
            self::ENGINE => 'المحرك',
            self::DASHBOARD => 'لوحة العدادات',
            self::ODOMETER => 'عداد المسافات',
        };
    }
}
