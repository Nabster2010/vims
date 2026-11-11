<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;

class CustomPortSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/custom_ports.json');

        if (! File::exists($path)) {
            throw new RuntimeException(
                "Custom ports file not found: {$path}"
            );
        }

        $ports = json_decode(
            File::get($path),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if (! is_array($ports)) {
            throw new RuntimeException(
                'Invalid custom_ports.json format.'
            );
        }

        $now = now();

        $rows = collect($ports)
            ->map(function (array $port) use ($now) {
                foreach (
                    ['name', 'name_ar', 'code', 'is_active'] as $key
                ) {
                    if (! array_key_exists($key, $port)) {
                        throw new RuntimeException(
                            "Missing key [{$key}] in custom_ports.json."
                        );
                    }
                }

                return [
                    'name' => trim($port['name']),
                    'name_ar' => trim($port['name_ar']),
                    'code' => trim((string) $port['code']),
                    'is_active' => (bool) $port['is_active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })
            ->unique(
                fn (array $port) => $port['name'].'|'.$port['code']
            )
            ->values();

        if ($rows->isEmpty()) {
            throw new RuntimeException(
                'No custom ports found in custom_ports.json.'
            );
        }

        DB::transaction(function () use ($rows, $now) {
            foreach ($rows as $port) {
                DB::table('custom_ports')->updateOrInsert(
                    [
                        'name' => $port['name'],
                        'code' => $port['code'],
                    ],
                    [
                        'name_ar' => $port['name_ar'],
                        'is_active' => $port['is_active'],
                        'updated_at' => $now,
                    ]
                );
            }
        });

        $this->command?->info(
            "Custom ports processed: {$rows->count()}"
        );
    }
}
