<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/countries.json');

        if (! File::exists($path)) {
            throw new RuntimeException(
                "Countries file not found: {$path}"
            );
        }

        $countries = json_decode(
            File::get($path),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $now = now();

        $rows = collect($countries)
            ->map(function (array $country) use ($now) {
                foreach (['name', 'name_ar', 'iso2', 'iso3', 'is_active'] as $key) {
                    if (! array_key_exists($key, $country)) {
                        throw new RuntimeException(
                            "Missing key [{$key}] in countries.json."
                        );
                    }
                }

                return [
                    'name' => $country['name'],
                    'name_ar' => $country['name_ar'],
                    'iso2' => strtoupper($country['iso2']),
                    'iso3' => strtoupper($country['iso3']),
                    'is_active' => $country['is_active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })
            ->unique('iso2')
            ->values();

        if ($rows->isEmpty()) {
            throw new RuntimeException(
                'No countries found in countries.json.'
            );
        }

        foreach ($rows->chunk(100) as $chunk) {
            DB::table('countries')->upsert(
                $chunk->all(),
                ['iso2'],
                [
                    'name',
                    'name_ar',
                    'iso3',
                    'is_active',
                    'updated_at',
                ]
            );
        }

        $this->command?->info(
            "Countries processed: {$rows->count()}"
        );
    }
}
