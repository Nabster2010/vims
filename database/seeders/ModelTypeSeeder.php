<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use App\Models\ModelType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModelTypeSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            'Toyota' => [
                ['Corolla', 'كورولا'],
                ['Camry', 'كامري'],
                ['Hilux', 'هايلوكس'],
                ['Land Cruiser', 'لاند كروزر'],
            ],

            'Honda' => [
                ['Civic', 'سيفيك'],
                ['Accord', 'أكورد'],
                ['CR-V', 'سي آر-في'],
            ],

            'Hyundai' => [
                ['Accent', 'أكسنت'],
                ['Elantra', 'إلنترا'],
                ['Sonata', 'سوناتا'],
            ],

            'Kia' => [
                ['Rio', 'ريو'],
                ['Cerato', 'سيراتو'],
                ['Sportage', 'سبورتاج'],
            ],

            'Nissan' => [
                ['Sunny', 'صني'],
                ['Patrol', 'باترول'],
                ['Altima', 'ألتيما'],
            ],
        ];

        foreach ($models as $manufacturerName => $types) {

            $manufacturer = Manufacturer::where('name', $manufacturerName)->first();

            if (! $manufacturer) {
                continue;
            }

            $rows = [];

            foreach ($types as [$name, $nameAr]) {
                $rows[] = [
                    'uuid' => (string) Str::uuid(),
                    'manufacturer_id' => $manufacturer->id,
                    'name' => $name,
                    'name_ar' => $nameAr,
                    'is_active' => true,
                ];
            }

            ModelType::upsert(
                $rows,
                ['manufacturer_id', 'name'],
                ['name_ar', 'is_active']
            );
        }
    }
}
