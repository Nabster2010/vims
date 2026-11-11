<?php

namespace App\Services;

use Alkoumi\LaravelHijriDate\Hijri;
use Carbon\Carbon;
use DateTimeInterface;

class DateService
{
    public function gregorian(
        DateTimeInterface|string|null $date,
        string $format = 'd/m/Y'
    ): ?string {
        if (! $date) {
            return null;
        }

        return Carbon::parse($date)->format($format);
    }

    public function hijri(
        DateTimeInterface|string|null $date,
        string $format = 'd/m/Y'
    ): ?string {
        if (! $date) {
            return null;
        }

        return Hijri::Date($format, $date);
    }

    public function both(
        DateTimeInterface|string|null $date,
        string $separator = ' الموافق '
    ): ?string {
        if (! $date) {
            return null;
        }

        return $this->gregorian($date)
            .$separator
            .$this->hijri($date);
    }
}
