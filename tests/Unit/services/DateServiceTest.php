<?php

use App\Services\DateService;
use Carbon\Carbon;

it('formats gregorian date from carbon instance', function () {

    $service = new DateService;

    $date = Carbon::create(2026, 11, 12);

    expect($service->gregorian($date))
        ->toBe('12/11/2026');
});

it('formats gregorian date from string', function () {

    $service = new DateService;

    expect($service->gregorian('2026-11-12'))
        ->toBe('12/11/2026');
});

it('formats gregorian date using custom format', function () {

    $service = new DateService;

    expect($service->gregorian(
        '2026-11-12',
        'Y-m-d'
    ))->toBe('2026-11-12');
});

it('returns null when gregorian date is null', function () {

    $service = new DateService;

    expect($service->gregorian(null))
        ->toBeNull();
});

it('formats hijri date', function () {

    $service = new DateService;

    expect($service->hijri('2026-11-12'))
        ->not->toBeNull();
});

it('returns null when hijri date is null', function () {

    $service = new DateService;

    expect($service->hijri(null))
        ->toBeNull();
});

it('returns both gregorian and hijri dates', function () {

    $service = new DateService;

    $result = $service->both('2026-11-12');

    expect($result)
        ->toContain('12/11/2026')
        ->toContain('الموافق');
});

it('returns both dates using custom separator', function () {

    $service = new DateService;

    $result = $service->both(
        '2026-11-12',
        ' | '
    );

    expect($result)
        ->toContain(' | ');
});

it('returns null when both date is null', function () {

    $service = new DateService;

    expect($service->both(null))
        ->toBeNull();
});
