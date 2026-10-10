<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name' => 'White', 'name_ar' => 'أبيض'],
            ['name' => 'Black', 'name_ar' => 'أسود'],
            ['name' => 'Silver', 'name_ar' => 'فضي'],
            ['name' => 'Gray', 'name_ar' => 'رمادي'],
            ['name' => 'Blue', 'name_ar' => 'أزرق'],
            ['name' => 'Red', 'name_ar' => 'أحمر'],
        ];

        foreach ($colors as &$color) {
            $color['uuid'] = (string) Str::uuid();
            $color['is_active'] = true;
        }

        Color::upsert(
            $colors,
            ['name'],
            ['name_ar', 'is_active']
        );
    }
}
