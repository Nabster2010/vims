<?php

namespace App\Enums;

enum ComplianceStatus: string
{
    case PASS = 'pass';
    case FAIL = 'fail';
    case NOT_APPLICABLE = 'not_applicable';

    public function label(): string
    {
        return match ($this) {
            self::PASS => 'Pass',
            self::FAIL => 'Fail',
            self::NOT_APPLICABLE => 'Not Applicable',
        };
    }

    public function labelAr(): string
    {
        return match ($this) {
            self::PASS => 'اجتياز',
            self::FAIL => 'فشل',
            self::NOT_APPLICABLE => 'لا ينطبق',
        };
    }
}
