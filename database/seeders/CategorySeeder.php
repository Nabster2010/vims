<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Passenger Car', 'name_ar' => 'سيارة ركاب'],
            ['name' => 'SUV', 'name_ar' => 'دفع رباعي'],
            ['name' => 'Pickup', 'name_ar' => 'بيك أب'],
            ['name' => 'Truck', 'name_ar' => 'شاحنة'],
            ['name' => 'Bus', 'name_ar' => 'حافلة'],
            ['name' => 'Motorcycle', 'name_ar' => 'دراجة نارية'],
        ];

        foreach ($categories as &$category) {
            $category['uuid'] = (string) Str::uuid();
            $category['is_active'] = true;
        }

        Category::upsert(
            $categories,
            ['name'],
            ['name_ar', 'is_active']
        );
    }
}
