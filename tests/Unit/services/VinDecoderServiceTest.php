<?php

use App\Services\Inspection\VinDecoderService;

it('returns model year for valid vin', function () {

    $service = new VinDecoderService();

    expect($service->modelYear('1HGCM8263AT123456'))
        ->toBe(2010);

    expect($service->modelYear('1HGCM8263BT123456'))
        ->toBe(2011);

    expect($service->modelYear('1HGCM8263CT123456'))
        ->toBe(2012);

    expect($service->modelYear('1HGCM8263LT123456'))
        ->toBe(2020);

    expect($service->modelYear('1HGCM8263RT123456'))
        ->toBe(2024);

    expect($service->modelYear('1HGCM8263YT123456'))
        ->toBe(2030);
});

it('returns null for vin with invalid length', function () {

    $service = new VinDecoderService();

    expect($service->modelYear('123456'))
        ->toBeNull();

    expect($service->modelYear('1234567890123456'))
        ->toBeNull();

    expect($service->modelYear('123456789012345678'))
        ->toBeNull();
});

it('returns null for unknown model year code', function () {

    $service = new VinDecoderService();

    expect($service->modelYear('1HGCM8263ZT123456'))
        ->toBeNull();

    expect($service->modelYear('1HGCM82639T123456'))
        ->toBeNull();

    expect($service->modelYear('1HGCM8263IT123456'))
        ->toBeNull();
});

it('accepts lowercase model year code', function () {

    $service = new VinDecoderService();

    expect($service->modelYear('1HGCM8263aT123456'))
        ->toBe(2010);
});
