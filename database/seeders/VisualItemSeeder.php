<?php

namespace Database\Seeders;

use App\Models\VisualItem;
use Illuminate\Database\Seeder;

class VisualItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Brake hoses',
                'code' => 'BRAKE_HOSES',
                'category' => 'Brakes',
                'sort_order' => 1,
            ],
            [
                'name' => 'Windshield',
                'code' => 'WINDSHIELD',
                'category' => 'Body',
                'sort_order' => 2,
            ],
            [
                'name' => 'Mirrors',
                'code' => 'MIRRORS',
                'category' => 'Body',
                'sort_order' => 3,
            ],
            [
                'name' => 'Doors',
                'code' => 'DOORS',
                'category' => 'Body',
                'sort_order' => 4,
            ],
            [
                'name' => 'Seat belts',
                'code' => 'SEAT_BELTS',
                'category' => 'Safety',
                'sort_order' => 5,
            ],
            [
                'name' => 'Horn',
                'code' => 'HORN',
                'category' => 'Electrical',
                'sort_order' => 6,
            ],
            [
                'name' => 'Number plate',
                'code' => 'NUMBER_PLATE',
                'category' => 'Body',
                'sort_order' => 7,
            ],
            [
                'name' => 'Tyres',
                'code' => 'TYRES',
                'category' => 'Wheels',
                'sort_order' => 8,
            ],
            [
                'name' => 'Leaks',
                'code' => 'LEAKS',
                'category' => 'Engine',
                'sort_order' => 9,
            ],
            [
                'name' => 'Battery',
                'code' => 'BATTERY',
                'category' => 'Electrical',
                'sort_order' => 10,
            ],
            [
                'name' => 'Lights',
                'code' => 'LIGHTS',
                'category' => 'Electrical',
                'sort_order' => 11,
            ],
            [
                'name' => 'Wipers',
                'code' => 'WIPERS',
                'category' => 'Body',
                'sort_order' => 12,
            ],
            [
                'name' => 'Exhaust system',
                'code' => 'EXHAUST',
                'category' => 'Engine',
                'sort_order' => 13,
            ],
            [
                'name' => 'Steering',
                'code' => 'STEERING',
                'category' => 'Steering',
                'sort_order' => 14,
            ],
            [
                'name' => 'Suspension',
                'code' => 'SUSPENSION',
                'category' => 'Suspension',
                'sort_order' => 15,
            ],
        ];

        foreach ($items as $item) {
            VisualItem::updateOrCreate(
                ['code' => $item['code']],
                $item
            );
        }
    }
}
