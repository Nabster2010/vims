<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $manufacturers = [
            ['name' => 'Toyota', 'name_ar' => 'تويوتا'],
            ['name' => 'Honda', 'name_ar' => 'هوندا'],
            ['name' => 'Hyundai', 'name_ar' => 'هيونداي'],
            ['name' => 'Kia', 'name_ar' => 'كيا'],
            ['name' => 'Nissan', 'name_ar' => 'نيسان'],
            ['name' => 'Ford', 'name_ar' => 'فورد'],
            ['name' => 'Chevrolet', 'name_ar' => 'شفروليه'],
            ['name' => 'Mercedes-Benz', 'name_ar' => 'مرسيدس بنز'],
            ['name' => 'BMW', 'name_ar' => 'بي إم دبليو'],
            ['name' => 'Lexus', 'name_ar' => 'لكزس'],
        ];

        foreach ($manufacturers as &$manufacturer) {
            $manufacturer['uuid'] = (string) Str::uuid();
            $manufacturer['is_active'] = true;
        }

        Manufacturer::upsert(
            $manufacturers,
            ['name'],
            ['name_ar', 'is_active']
        );
    }
}
